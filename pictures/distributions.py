'''
Created on May 13, 2010

@author: chris
'''
import json
import math
import cairo
import sys
import random
import csv
import numpy
from scipy.stats import truncnorm

# some overall parameters
scale = 10
coefficient = 10
color_index = {"1": "orange",
               "0": "blue",
               }


# sample relevant data with truncnorm distribution
def sample_data(my_mean, my_std, myclip_a, myclip_b, size):
    a, b = (myclip_a - my_mean) / my_std, (myclip_b - my_mean) / my_std
    r = float(truncnorm.rvs(a, b, loc=my_mean, scale=my_std, size=size))
    return r


class Shape(object):

    def __init__(self, context, x, y, h, w, d, c, p):
        # super(object, self).__init__()
        self.context = context
        self.x = x
        self.y = y
        self.h = h
        self.w = w
        self.d = d
        self.color = c
        self.pattern = p
        self.parameters = (x, y, h, w, d, c, p)

    def get_parameters(self):
        return self.parameters

    def set_color(self):
        if self.color == 'orange':
            self.context.set_source_rgb(0.9, 0.65, 0.0)
        elif self.color == 'blue':
            self.context.set_source_rgb(0.35, 0.7, 0.9)
        elif self.color == 'grey':
            self.context.set_source_rgb(0.55, 0.51, 0.53)
        elif self.color == 'brown':
            self.context.set_source_rgb(0.65, 0.16, 0.16)
        elif self.color == 'magenta':
            self.context.set_source_rgb(0.8, 0.06 ,0.8)
        elif self.color == 'green':
            self.context.set_source_rgb(0.33, 0.8, 0.11)


class Heart(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        degree = 1.2
        self.set_color()
        x = x + 40
        y = y - 75
        xoffset = 50 * degree
        yoffset1 = 30 * degree
        yoffset2 = 35 * degree
        self.context.move_to(x,y)
        self.context.curve_to(x, y - yoffset1, x - xoffset, y - yoffset1, x - xoffset, y)
        self.context.curve_to(x - xoffset, y + yoffset1, x, y + yoffset2, x, y + 2*yoffset1)
        self.context.curve_to(x, y + yoffset2, x + xoffset, y + yoffset1, x + xoffset, y)
        self.context.curve_to(x + xoffset, y - yoffset1, x, y - yoffset1, x, y)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()
        self.context.save()

class Star(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        degree = 1
        bottom = 50 * degree
        diag = bottom / math.cos(math.pi / 5)
        height = diag * math.sin(math.pi / 5)
        height_arg = bottom * math.sin(math.pi / 5)
        width_arg = bottom * math.cos(math.pi / 5)
        y = y - 80
        x = x - 40
        points = (
            (x, y),
            (x + diag, y),
            (x + diag + bottom / 2, y - diag * math.cos(math.pi / 10)),
            (x + diag + bottom, y),
            (x + (2 * diag) + bottom, y),
            (x + (2 * diag) + bottom - diag * math.cos(math.pi / 5), y + diag * math.sin(math.pi / 5)),
            (x + (2 * diag + bottom) * math.cos(math.pi / 5), y + (2 * diag + bottom) * math.sin(math.pi / 5)),
            (x + diag + bottom / 2, y + (bottom + diag) * math.sin(math.pi / 5)),
            (x + (((2 * diag) + bottom) - (2 * diag + bottom) * math.cos(math.pi / 5)), y + (2 * diag + bottom) * math.sin(math.pi / 5)),
            (x + diag * math.cos(math.pi / 10), y + diag * math.sin(math.pi / 5)),
            (x, y),
        )
        for i in range(10):
            self.context.line_to(points[i][0], points[i][1])
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()
        self.context.save()

class Triangle(Shape):
    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        if degree == "1":
            degree = 120
        elif degree == "0":
            degree = 80
        x= x - 25
        self.context.move_to(x, y)
        self.context.line_to(x + degree / 2, y - degree)
        self.context.line_to(x + degree, y)
        self.context.line_to(x, y)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()
        self.context.save()


class Rectangle(Shape):
    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        x = x
        y = y - 100
        max_length = 100
        self.context.rectangle(x, y, max_length, max_length)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()
        self.context.save()

class Diamond(Shape):
    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        x = x + 45
        y = y - 80
        degree = 0.2
        std_length = 90 * degree
        self.context.move_to(x, y-std_length)
        self.context.line_to(x+std_length, y)
        self.context.line_to(x, y+std_length)
        self.context.line_to(x-std_length,y)
        self.context.close_path()
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()
        self.context.save()


class Circle(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        x = x + 40
        max_radius = 80
        self.context.arc(x, y - max_radius, max_radius, 0, 2 * math.pi)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()


# read csv file as list of lists of strings
with open('../stimuli_table.csv', 'r', encoding='latin-1') as f:
    reader = csv.reader(f)
    # skip header
    next(reader, None)
    stimuli_file = list(reader)


# create dict with relevant data
def create_dict(line):
    line_string = ";".join(str(x) for x in line)
    line_cells = line_string.split(";")
    return {
        "item": line_cells[0],
		"condition": line_cells[1],
        "shape": line_cells[2],
        "size": [line_cells[3], line_cells[4], line_cells[5], line_cells[6]],
        "colour": [line_cells[7], line_cells[8], line_cells[9], line_cells[10]],
        "pattern": [line_cells[11], line_cells[12], line_cells[13], line_cells[14]],
        "marked": line_cells[15]
    }


# create list of dicts for each extracted line
trial_dicts_list = list(map(create_dict, stimuli_file))


# main function
def main():
    for t in trial_dicts_list:
        filename = "pic" + t["item"] +  t["condition"] + ".svg"
        shape = t["shape"]
        pattern = t["pattern"]
        size = t["size"]
        color = t["colour"]
        if t["marked"] == "A":
            marked = 1
        elif t["marked"] == "B":
            marked = 2
        elif t["marked"] == "C":
            marked = 3
        elif t["marked"] == "D":
            marked = 4
        suffled_objects = numpy.random.permutation([0, 1, 2, 3])
        print(suffled_objects)
        marked = numpy.where(suffled_objects == marked-1)[0]
        print(marked)
        offset = 100
        height = 200
        width = 0.45 * height
        window_width = 4 * (offset + width) + offset
        window_height = 1.5 * height
        bottom = 1.25 * height
        horizontal_distance = width + offset
        s = cairo.SVGSurface(filename, window_width, window_height)
        c = cairo.Context(s)
        c.set_source_rgb(0.9, 0.9, 0.9)
        c.rectangle(0, 0, window_width, window_height)
        c.fill()
        c.set_source_rgba(0.9, 0.5, 0.5, 0.5)
        c.rectangle((offset / 2) + horizontal_distance * marked, bottom + 0.1 * height,
                    horizontal_distance, -height * 1.2)
        c.fill()
        for i in range(0, 4):
            pattern = t["pattern"][suffled_objects[i]]
            deg = t["size"][suffled_objects[i]]
            color = t["colour"][suffled_objects[i]]
            # std_degree = max([float(x) for x in size]) / coefficient
            # deg = sample_data(my_mean=mean_degree, my_std=std_degree, myclip_a=1,
            #                  myclip_b=mean_degree + std_degree, size=1) * coefficient
            # print("std:" + str(std_degree))
            print("deg:" + str(deg))
            if shape == "Dreieck":
                tmp = Heart(c, offset + horizontal_distance * i, bottom, height, width, deg,
                               color, pattern)
                tmp.draw()
            # if shape == "Dreieck":
            #     tmp = Dreieck(c, offset + horizontal_distance * i, bottom, height, width, deg, color, pattern)
            #     tmp.draw()
            # if shape == "Kreis":
            #     tmp = Kugel(c, offset + 0.5 * width + horizontal_distance * i, bottom, height, width,
            #                 deg, color, pattern)
            #     tmp.draw()

        s.finish()


if __name__ == '__main__':
    main()
