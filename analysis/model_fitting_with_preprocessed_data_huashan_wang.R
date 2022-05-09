rm(list = ls())
load ("data_preprocessed_huashan.RData")
library(tidyr)
library(ggplot2)
library(gridExtra)
library(trimr)
library(stringr)
library(lme4)
library(lmerTest)
library(dplyr)
library(effects)
library(optimx)


# set up contrast coding
mean(data$prefer_first_1st)
contrasts(data$combination)
contrasts(data$relevant_property)
data$dist <- factor(data$dist, levels = c("sharp","blurred"))
contrasts(data$dist) <- c(-0.5, 0.5)
colnames(contrasts(data$dist)) <- c("blurred")

#maximaze the random effect structure
m0 <- lmer(prefer_first_1st~relevant_property*combination*dist
           +(1|id)
           +(1|item), data=data)
summary(m0)
anova(m0)

m1 <-  update(m0, .~.-combination:dist:relevant_property)
anova(m1,m0)

m2 <-  update(m1, .~.-combination:dist)
anova(m2,m1)

m3 <-  update(m2, .~.-dist:relevant_property)
anova(m3,m2)

m4 <-  update(m3, .~.-combination:relevant_property)
anova(m4,m3)

m5 <-  update(m4, .~.-combination)
anova(m5,m4)

m6 <-  update(m5, .~.-dist)
anova(m6,m5)

m7 <-  update(m6, .~.-relevant_property)
anova(m7,m6)

