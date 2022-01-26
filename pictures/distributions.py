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
color_index = {"5": "orange",
               "6": "blue",
               "7": "grey",
               "8": "black",
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
        self.p = p
        self.parameters = (x, y, h, w, d, c, p)

    def get_parameters(self):
        return self.parameters

    def set_color(self):

        if self.color == '5':  # orange
            self.context.set_source_rgb(0.9, 0.65, 0.0)
        elif self.color == '6':  # blue
            self.context.set_source_rgb(0.35, 0.7, 0.9)
        elif self.color == '7':  # gray
            self.context.set_source_rgb(0.5, 0.5, 0.5)
        elif self.color == '8':  # black
            self.context.set_source_rgb(0.0, 0.0, 0.0)


class Glass(Shape):

    def __init__(self, context, x, y, h, w, d, c):
        Shape.__init__(self, context, x, y, h, w, d, c)

    def draw(self):
        x, y, height, width, degree, color = self.get_parameters()
        base = 0.09 * height
        ratio = 0.5
        self.context.scale(1, ratio)
        y = y - ratio * width
        y = y / ratio
        self.context.move_to(x, y)
        self.context.line_to(x, y - height)
        self.context.move_to(x, y)
        self.context.line_to(x + width, y)
        self.context.move_to(x + width, y)
        self.context.line_to(x + width, y - height)
        self.context.close_path()
        self.context.set_line_width(2.0)
        self.context.stroke_preserve()
        self.context.fill()
        # self.context.save()
        # self.context.set_line_width(2.0)
        # self.context.stroke_preserve()
        # self.context.set_source_rgb(0.3, 1, 0.3)
        # self.context.fill()
        # self.context.restore()
        # self.context.close_path()
        # self.context.save()
        c1, c2, c3 = random.random(), random.random(), random.random()
        # self.context.rotate(0.1*math.pi)
        self.context.set_source_rgba(c1 * 0.5, c2 * 0.5, c3 * 0.7, 1)
        self.context.rectangle(x, y - degree * height, width, degree * height)
        self.context.fill()
        # self.context.close_path()
        # self.context.save()
        self.context.set_source_rgba(c1 * 0.3, c2 * 0.3, c3 * 0.4, 1)
        self.context.arc(x + width / 2, y, width / 2 + 1, 0, math.pi)
        self.context.fill()
        self.context.rectangle(x - self.context.get_line_width() * 0.5, y - base, width + self.context.get_line_width(),
                               base)
        self.context.fill()
        self.context.arc(x + width / 2, y - base, width / 2 + 1, math.pi, 2 * math.pi)
        self.context.fill()
        self.context.set_source_rgba(c1 * 0.6, c2 * 0.6, c3 * 0.8, 1)
        self.context.arc(x + width / 2, y - degree * height, width / 2 + 1, 0, math.pi)
        self.context.fill()
        # self.context.rectangle(x-self.context.get_line_width()*0.5, y-base, width+self.context.get_line_width(), base)
        # self.context.fill()
        self.context.set_source_rgba(1, 1, 1, 1)
        self.context.arc(x + width / 2, y - degree * height, width / 2 + 1, math.pi, 2 * math.pi)
        self.context.fill()
        self.context.set_source_rgba(c1 * 0.6, c2 * 0.6, c3 * 0.8, 1)
        self.context.arc(x + width / 2, y - degree * height, width / 2 + 1, math.pi, 2 * math.pi)
        self.context.fill()
        self.context.set_source_rgba(color[0], color[1], color[2], color[3])
        self.context.arc(x + width / 2, y - height, width / 2, 0, 2 * math.pi)
        self.context.stroke()
        self.context.scale(1, 1 / ratio)
        self.context.set_source_rgba(color[0], color[1], color[2], color[3])


class Building(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        self.set_color()
        self.context.rectangle(x, y, width, -15)
        self.context.rectangle(x, y - 15, width, -degree)
        self.context.fill()
        self.context.set_source_rgba(0.8, 0.4, 0, 1)
        self.context.rectangle(x + width * 0.7, y, 0.15 * width, -15)
        self.context.fill()
        self.context.set_source_rgba(0.8, 0.2, 0.2, 0.9)
        self.context.move_to(x, y - degree - 15)
        if pattern == "x":
            self.context.line_to(x + width / 2, y - degree - 45)
        elif pattern == "y":
            self.context.line_to(x + width / 2, y - degree - 25)
        self.context.line_to(x + width, y - degree - 15)
        self.context.fill()
        self.context.save()


class Line(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        self.set_color()
        # sample rad with truncnorm distribution, mu = 45, std =15 in [30,60]
        rad = sample_data(my_mean=45, my_std=90, myclip_a=30, myclip_b=90, size=1)
        ax, ay = x-40, y-30
        self.context.move_to(ax, ay)
        bx = ax + degree * math.cos(rad * math.pi / 180)
        by = ay - degree * math.sin(rad * math.pi / 180)
        cx = ax + sample_data(my_mean=degree, my_std=(degree / scale), myclip_a=degree - 2 * (degree / scale),
                              myclip_b=degree + 2 * (degree / scale), size=1)
        cy = by
        dx = cx + degree * math.cos(rad * math.pi / 180)
        dy = cy - degree * math.sin(rad * math.pi / 180)
        self.context.curve_to(bx, by, cx, cy, dx, dy)
        if pattern == "x":
            self.context.set_line_width(5)
        elif pattern == "y":
            self.context.set_line_width(15)
        self.context.stroke()
        self.context.save()


class Bar(Shape):

    def __init__(self, context, x, y, h, w, d, c):
        Shape.__init__(self, context, x, y, h, w, d, c)

    def draw(self):
        x, y, height, width, degree, color = self.get_parameters()
        c1, c2, c3 = random.random(), random.random(), random.random()
        # self.context.rotate(0.1*math.pi)
        self.context.set_source_rgba(c1 * 0.5, c2 * 0.5, c3 * 0.5, 1)
        # self.context.set_source_rgba(0.2, 0.3, 0.7, 0.6)
        self.context.translate(x + 2.5, y - height / 5 - 10)
        self.context.rotate(-1.2 * math.pi * 0.5 * degree + 0.04 * math.pi)
        self.context.translate(-x - 2.5, -y + height / 5 + 10)
        self.context.rectangle(x - 15, y - height / 5 - 8, width * 1.1, 5)
        # self.context.rectangle(x,y,width/5,-height/5)
        self.context.translate(x + 2.5, y - height / 5 - 10)
        self.context.rotate(1.2 * math.pi * 0.5 * degree - 0.04 * math.pi)
        self.context.translate(-x - 2.5, -y + height / 5 + 10)
        # self.context.rotate(-0.1*math.pi)
        self.context.fill()
        self.context.set_source_rgba(c1 * 0.8, c2 * 0.8, c3 * 0.8, 1)
        self.context.rectangle(x, y, width / 5, -height / 5 * 1.2)
        self.context.rectangle(x + 0.9 * width, y, width / 25, -height / 5 * 1.2)
        self.context.fill()
        self.context.set_source_rgba(0.1, 0.8, 0.1, 1)
        self.context.rectangle(x, y, x + width, 2)
        self.context.fill()
        # self.context.set_source_rgba(0,0,0,1)
        # self.context.rectangle(x+width/10, y-height/10, 20, 20)
        self.context.fill()
        self.context.set_source_rgba(color[0], color[1], color[2], color[3])
        self.context.save()


class Ball(Shape):

    def __init__(self, context, x, y, h, w, d, c, p):
        Shape.__init__(self, context, x, y, h, w, d, c, p)

    def draw(self):
        x, y, height, width, degree, color, pattern = self.get_parameters()
        sr1 = cairo.ImageSurface.create_from_png("patterns/stripe-orange_bg_420.png")
        sr2 = cairo.ImageSurface.create_from_png("patterns/stripe-blue_bg_420.png")
        sr3 = cairo.ImageSurface.create_from_png("patterns/stripe-gray_bg_420.png")
        sr4 = cairo.ImageSurface.create_from_png("patterns/stripe-black_bg_420.png")
        sr5 = cairo.ImageSurface.create_from_png("patterns/dotted-orange_bg_420.png")
        sr6 = cairo.ImageSurface.create_from_png("patterns/dotted-blue_bg_420.png")
        sr7 = cairo.ImageSurface.create_from_png("patterns/dotted-gray_bg_420.png")
        sr8 = cairo.ImageSurface.create_from_png("patterns/dotted-black_bg_420.png")
        if pattern == "x":
            if color == "5":
                pat = cairo.SurfacePattern(sr1)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "6":
                pat = cairo.SurfacePattern(sr2)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "7":
                pat = cairo.SurfacePattern(sr3)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "8":
                pat = cairo.SurfacePattern(sr4)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
        elif pattern == "y":
            if color == "5":
                pat = cairo.SurfacePattern(sr5)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "6":
                pat = cairo.SurfacePattern(sr6)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "7":
                pat = cairo.SurfacePattern(sr7)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
            elif color == "8":
                pat = cairo.SurfacePattern(sr8)
                pat.set_extend(cairo.EXTEND_REPEAT)
                self.context.set_source(pat)
        self.context.arc(x, y - degree, degree, 0, 2 * math.pi)
        self.context.fill_preserve()
        self.context.set_source_rgba(0, 0, 0, 1)
        self.context.set_line_width(1)
        self.context.stroke()


# read csv file as list of lists of strings
with open('../Tabelle_neuesFormat_mitKontext_mitFillern_final2.csv', 'r', encoding='utf-8') as f:
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
		"condition": line_cells[19],
        "shape": line_cells[1],
        "pattern": line_cells[2],
        "size": [line_cells[3], line_cells[4], line_cells[5], line_cells[6], line_cells[7], line_cells[8]],
        "colour": [line_cells[9], line_cells[10], line_cells[11], line_cells[12], line_cells[13], line_cells[14]],
        "marked": line_cells[15]
    }


# create list of dicts for each extracted line
trial_dicts_list = list(map(create_dict, stimuli_file))


# print(trial_dicts_list)
# some overall parameters


# main function
def main():
    for t in trial_dicts_list:
        filename = "pic" + t["item"] + t["condition"] +".svg"
        shape = t["shape"]
        pattern = t["pattern"]
        reversed_parrens =	{
            "x": "y",
            "y": "x"
        } 
        size = t["size"]
        colour = t["colour"]
        suffled_objects = numpy.random.permutation([0, 1, 2, 3, 4, 5])#521430 -> [5]
        print(suffled_objects)
        marked = numpy.where(suffled_objects == int(t["marked"])-1)[0]
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
                    horizontal_distance, -height * 1.2)
        c.fill()
        for i in range(0, 6):		
            mean_degree = float(size[suffled_objects[i]])
            color = colour[suffled_objects[i]]
            if random.random() > 0.9: pattern = reversed_parrens[pattern] 
            std_degree = max([float(x) for x in size]) / coefficient
            deg = sample_data(my_mean=mean_degree, my_std=std_degree, myclip_a=1,
                              myclip_b=10, size=1) * coefficient
            print("std:" + str(std_degree))
            print("deg:" + str(deg))
            print("col:" + color)
            if shape == "Haus":
                tmp = Building(c, offset + horizontal_distance * i, bottom, height, width, deg,
                               color, pattern)
                tmp.draw()
            if shape == "Linie":
                tmp = Line(c, offset + horizontal_distance * i, bottom, height, width, deg, color, pattern)
                tmp.draw()
            if shape == "Ball":
                tmp = Ball(c, offset + 0.5 * width + horizontal_distance * i, bottom, height, width,
                           deg, color, pattern)
                tmp.draw()

        s.finish()


if __name__ == '__main__':
    main()
