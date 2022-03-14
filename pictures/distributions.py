'''
Created on May 13, 2010

@author: chris
'''
import copy
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


def adjust_size(max_size, size, coefficient):
    size = max_size * size * coefficient
    if size >= max_size:
        size = max_size
    return size


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
            self.context.set_source_rgb(0.55, 0.14, 0.14)
        elif self.color == 'black':
            self.context.set_source_rgb(0, 0, 0)
        elif self.color == 'green':
            self.context.set_source_rgb(0.67, 1, 0.18)


class Heart(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        degree = 0.15 * degree
        self.set_color()
        x = x + 45
        if degree >= 1:
            y = y - 100
        else:
            y = y - 80
        xoffset = 50 * degree
        yoffset1 = 30 * degree
        yoffset2 = 35 * degree
        self.context.move_to(x, y)
        self.context.curve_to(x, y - yoffset1, x - xoffset, y - yoffset1, x - xoffset, y)
        self.context.curve_to(x - xoffset, y + yoffset1, x, y + yoffset2, x, y + 2 * yoffset1)
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
        self.set_color()
        degree = 0.1 * degree
        bottom = 50 * degree
        diag = bottom / math.cos(math.pi / 5)
        if degree >= 0.7:
            y = y - 100
        else:
            y = y - 80
        if degree > 0.8:
            x = x - 40
        elif degree >= 0.3:
            x = x - 40 + 20 / degree
        else:
            x = x + 45
        points = (
            (x, y),
            (x + diag, y),
            (x + diag + bottom / 2, y - diag * math.cos(math.pi / 10)),
            (x + diag + bottom, y),
            (x + (2 * diag) + bottom, y),
            (x + (2 * diag) + bottom - diag * math.cos(math.pi / 5), y + diag * math.sin(math.pi / 5)),
            (x + (2 * diag + bottom) * math.cos(math.pi / 5), y + (2 * diag + bottom) * math.sin(math.pi / 5)),
            (x + diag + bottom / 2, y + (bottom + diag) * math.sin(math.pi / 5)),
            (x + (((2 * diag) + bottom) - (2 * diag + bottom) * math.cos(math.pi / 5)),
             y + (2 * diag + bottom) * math.sin(math.pi / 5)),
            (x + diag * math.cos(math.pi / 10), y + diag * math.sin(math.pi / 5)),
            (x, y),
        )
        for i in range(11):
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
        self.set_color()
        length = adjust_size(150, degree, 0.15)
        x = x + 45
        y = y - 70
        self.context.move_to(x, y - (math.sqrt(3) / 3 * length))
        self.context.line_to(x - length / 2, y + (3 / math.sqrt(3) / 6 * length))
        self.context.line_to(x + length / 2, y + (3 / math.sqrt(3) / 6 * length))
        self.context.line_to(x, y - (math.sqrt(3) / 3 * length))
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
        self.set_color()
        length = adjust_size(120, degree, 0.15)
        if degree >= 5:
            x = x
        else:
            x = x - 40
        y = y - 80
        self.context.rectangle(x - (length - 105), y - length / 2, length, length)
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
        self.set_color()
        x = x + 45
        y = y - 80
        std_length = adjust_size(80, degree, 0.1)
        self.context.move_to(x, y - std_length)
        self.context.line_to(x + std_length, y)
        self.context.line_to(x, y + std_length)
        self.context.line_to(x - std_length, y)
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
        self.set_color()
        x = x
        y = y - 80
        radius = adjust_size(70, degree, 0.15)
        self.context.arc(x, y, radius, 0, 2 * math.pi)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()


# read csv file as list of lists of strings
with open('../stimuli_scharf.csv', 'r', encoding='latin-1') as f:
    reader = csv.reader(f)
    # skip header
    next(reader, None)
    stimuli_file = list(reader)


# create dict with relevant data
def create_dict(line):
    line_string = ";".join(str(x) for x in line)
    line_cells = line_string.split(";")
    return {
        "list": line_cells[0],
        "item": line_cells[2],
        "condition": line_cells[3],
        "size": [line_cells[9], line_cells[10], line_cells[11], line_cells[12], line_cells[13], line_cells[14]],
        "color": [line_cells[15], line_cells[16], line_cells[17], line_cells[18], line_cells[19], line_cells[20]],
        "shape": [line_cells[21], line_cells[22], line_cells[23], line_cells[24], line_cells[25], line_cells[26]],
        "marked": line_cells[15]
    }

# create dict for all possible assets for each relevant feature
shape_dict = ['triangle', 'quadrat', 'circle', 'star', 'diamond', 'heart']
color_dict = ['green', 'blue', 'orange', 'black', 'grey', 'brown']
size_dict = [1, 2, 3, 9, 10]  # small: 1, 2, 3; large: 9, 10


# create list of dicts for each extracted line
trial_dicts_list = list(map(create_dict, stimuli_file))


# flip a unfair coin with certain p-value
def flip(p):
    return True if random.random() < p else False


# main function
def main():
    for t in trial_dicts_list:
        #filename = "test" + t["item"] + ".svg"
        filename = "pic" + t["item"] + t["condition"] + ".svg"
        pattern = 1
        suffled_objects = numpy.random.permutation([0, 1, 2, 3, 4, 5])
        print(suffled_objects)
        marked = numpy.where(suffled_objects == 0)[0]
        print(marked)
        offset = 100
        height = 200
        width = 0.45 * height
        window_width = 6 * (offset + width) + offset
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
                    horizontal_distance, -height * 1)
        c.set_source_rgb(1, 0, 0)
        c.set_line_width(5)
        c.stroke()
        current_color = numpy.random.permutation(color_dict)[0]
        current_shape = numpy.random.permutation(shape_dict)[0]
        current_shape_dict = copy.copy(shape_dict)
        current_color_dict = copy.copy(color_dict)
        for i in range(0, 6):
            shape = t["shape"][suffled_objects[i]]
            if t["size"][suffled_objects[i]] != 'NA':
                deg = int(t["size"][suffled_objects[i]])
            else:
                deg = numpy.random.permutation(size_dict)[0]
            color = t["color"][suffled_objects[i]]
            if shape == 'NA':
                if numpy.random.binomial(1, 0.7) == 1:
                    shape = current_shape
                    print("true")
                else:
                    current_shape_dict.remove(current_shape)
                    current_shape = numpy.random.permutation(current_shape_dict)[0]
                    shape = current_shape
                    print("false")
            if color == 'NA':
                if flip(0.7):
                    color = current_color
                else:
                    current_color_dict.remove(current_color)
                    current_color = numpy.random.permutation(current_color_dict)[0]
                    color = current_color
            print(suffled_objects[i])
            print("shape:" + shape)
            if shape == "heart":
                tmp = Heart(c, offset + horizontal_distance * i, bottom, height, width, deg,
                            color, pattern)
                tmp.draw()
            if shape == "quadrat":
                tmp = Rectangle(c, offset + horizontal_distance * i, bottom, height, width, deg,
                                color, pattern)
                tmp.draw()
            if shape == "star":
                tmp = Star(c, offset + horizontal_distance * i, bottom, height, width, deg,
                           color, pattern)
                tmp.draw()
            if shape == "diamond":
                tmp = Diamond(c, offset + horizontal_distance * i, bottom, height, width, deg,
                              color, pattern)
                tmp.draw()
            if shape == "triangle":
                tmp = Triangle(c, offset + horizontal_distance * i, bottom, height, width, deg, color, pattern)
                tmp.draw()
            if shape == "circle":
                tmp = Circle(c, offset + 0.5 * width + horizontal_distance * i, bottom, height, width,
                             deg, color, pattern)
                tmp.draw()

        s.finish()


if __name__ == '__main__':
    main()
