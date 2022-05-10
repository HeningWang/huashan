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
contrasts(data$dist) <- c(-0.5, 0.5)
colnames(contrasts(data$dist)) <- c("sharp")

#maximaze the random effect structure
m0 <- lmer(prefer_first_1st~relevant_property*combination*dist
           +(1|id)
           +(1|item), data=data)
summary(m0)
anova(m0)

# log transformation 
data$sli<-(data$prefer_first_1st+50.5)/101
m0.1 <- lmer(log(sli)~relevant_property*combination*dist
           +(1|id)
           +(1|item), data=data)
summary(m0)

data$transli<-qlogis(jitter(data$sli))

m0.2 <- lmer(transli~relevant_property*combination*dist
             +(1|id)
             +(1|item), data=data)

step(m0.1)

par(mfrow=c(1,3))
qqnorm(residuals(m0))
qqnorm(residuals(m0.1))
qqnorm(residuals(m0.2))

step(m0.2)

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

