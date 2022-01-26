#!/usr/bin/env python3

import json
import csv
# import image_generator
import shapesAndLocations
import math
import cairo
import sys
from scipy.stats import truncnorm

# some overall paramenters
x_coordinate_landmark_1 = 220
y_coordinate_landmark_1 = 220
x_coordinate_landmark_2 = 420
y_coordinate_landmark_2 = 420
sample_size = 32
window_size = 640
landmark_size = 32

# read csv file as list of lists of strings
with open('stimuli_input.csv', 'r', encoding='latin-1') as f:
    reader = csv.reader(f)
    # skip header
    next(reader, None)
    stimuli_file = list(reader)


# create dict with relevant data
def create_dict(line):
    line_string = ";".join(str(x) for x in line)
    line_cells = line_string.split(";")
    if line_cells[7] == "N":
        return {"item": line_cells[0],
                "sentence": line_cells[1],
                "landmark_color_1": line_cells[2],
                "trajector_color_1": line_cells[3],
                "landmark_color_2": line_cells[4],
                "trajector_color_2": line_cells[5],
                "size": int(line_cells[6]),
                "shape": "circle",
                'trajector_degree_1': sample_data(my_mean=0, my_std=45, myclip_a=-45, myclip_b=45, size=1),
                'trajector_radius_1': sample_data(my_mean=125, my_std=25, myclip_a=100, myclip_b=150, size=1),
                'reference_object_for_1.trajector': line_cells[7],
                'second_trajecor': line_cells[8],
                'list': line_cells[10]
                }
    else:
        return {"item": line_cells[0],
                "sentence": line_cells[1],
                "landmark_color_1": line_cells[2],
                "trajector_color_1": line_cells[3],
                "landmark_color_2": line_cells[4],
                "trajector_color_2": line_cells[5],
                "size": int(line_cells[6]),
                "shape": "circle",
                'trajector_degree_1': sample_data(my_mean=0, my_std=45, myclip_a=-45, myclip_b=45, size=1),
                'trajector_radius_1': sample_data(my_mean=125, my_std=25, myclip_a=100, myclip_b=150, size=1),
                'reference_object_for_1.trajector': line_cells[7],
                'second_trajecor': line_cells[8],
                'trajector_degree_2': sample_data(my_mean=0, my_std=45, myclip_a=-45, myclip_b=45, size=1),
                'trajector_radius_2': sample_data(my_mean=125, my_std=25, myclip_a=100, myclip_b=150, size=1),
                'reference_object_for_2.trajector': line_cells[9],
                'list': line_cells[10]
                }


# sample relevant data with truncnorm distribution
def sample_data(my_mean, my_std, myclip_a, myclip_b, size):
    a, b = (myclip_a - my_mean) / my_std, (myclip_b - my_mean) / my_std
    r = float(truncnorm.rvs(a, b, loc=my_mean, scale=my_std, size=size))
    return r


# calculate x and y coordinate of trajector(s)
def trajector_position(degree, radius, reference_object):
    if reference_object == "1":
        x_coordinate = x_coordinate_landmark_1 + radius * math.cos(math.pi / 180 * (degree - 45))
        y_coordinate = y_coordinate_landmark_1 - radius * math.sin(math.pi / 180 * (degree - 45))
    elif reference_object == "2":
        x_coordinate = x_coordinate_landmark_2 + radius * math.cos(math.pi / 180 * (degree + 135))
        y_coordinate = y_coordinate_landmark_2 - radius * math.sin(math.pi / 180 * (degree + 135))
    return x_coordinate, y_coordinate


# create list of dicts for each extracted line
trial_dicts_list = list(map(create_dict, stimuli_file))

# export generated data into .csv file
keys = trial_dicts_list[0].keys()
with open('stimuli_output.csv', 'w', newline='')  as output_file:
    dict_writer = csv.DictWriter(output_file, keys)
    dict_writer.writeheader()
    dict_writer.writerows(trial_dicts_list)


def main():
    for t in trial_dicts_list:
        filename = "web/" + "pictures/" + "pic" + t["item"] + ".svg"
        landmark_color_1 = t["landmark_color_1"]
        trajector_color_1 = t["trajector_color_1"]
        landmark_color_2 = t["landmark_color_2"]
        trajector_color_2 = t["trajector_color_2"]
        trajector_size = t["size"]
        s = cairo.SVGSurface(filename, window_size, window_size)
        c = cairo.Context(s)
        c.set_source_rgb(0.9, 0.9, 0.9)
        c.rectangle(0, 0, window_size, window_size)
        c.fill()
        tmp = shapesAndLocations.Landmark(c, x_coordinate_landmark_1, y_coordinate_landmark_1, landmark_size,
                                          landmark_color_1)
        tmp.draw()
        tmp = shapesAndLocations.Landmark(c, x_coordinate_landmark_2, y_coordinate_landmark_2, landmark_size,
                                          landmark_color_2)
        tmp.draw()
        trajector_position_1 = trajector_position(t["trajector_degree_1"], t["trajector_radius_1"],
                                                  t['reference_object_for_1.trajector'])
        tmp = shapesAndLocations.Circle(c, trajector_position_1[0], trajector_position_1[1], trajector_size,
                                        trajector_color_1)
        tmp.draw()
        if 'reference_object_for_2.trajector' in t:
            trajector_position_2 = trajector_position(t["trajector_degree_2"], t["trajector_radius_2"],
                                                      t['reference_object_for_2.trajector'])
            tmp = shapesAndLocations.Circle(c, trajector_position_2[0], trajector_position_2[1], trajector_size,
                                            trajector_color_2)
            tmp.draw()
        s.finish()
    # TODO: convert svgs to pngs using sys


if __name__ == '__main__':
    main()

print(trial_dicts_list)

print("total number of trials: " + str(len(trial_dicts_list)))

trials = json.dumps(trial_dicts_list, ensure_ascii=False)

out = "const maintrials =" + trials

out_unicode = out.encode("utf8")

# save file as stimuli.js
f = open("web\js\stimuli.js", "wb")
f.write(out_unicode)
f.close()

# trials = json.dumps(trial_dicts_list)

# out = "const maintrials ="+trials

# save file as stimuli.js
# f = open("web\js\stimuli.js","w+")
# f.write(out)
# f.close()
