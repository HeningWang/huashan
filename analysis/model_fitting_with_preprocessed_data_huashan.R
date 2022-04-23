rm(list = ls())
load ("data_preprocessed_for_analysis_of_none_fit_huashan.RData")
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

# analyse none fits using glmer
nonefit_mh1 <- glmer(none_fits ~ 1 + conditions*dist + (1|id) + (1|item), data=data_preprocessed_for_analysis_of_none_fit_huashan, 
family=binomial, nAGQ=1, control = glmerControl(optimizer ='bobyqa'))
summary(nonefit_mh1)
nonefit_mh0 <- glmer(none_fits ~ 1 + (1|id) + (1|item), data=data_preprocessed_for_analysis_of_none_fit_huashan, 
                    family=binomial, nAGQ=0, control = glmerControl(optimizer ='bobyqa'))
summary(nonefit_mh0)
anova(nonefit_mh0,nonefit_mh1)
#mm <- allFit(nonefit_m0)
#nonefit_m1 <- update(nonefit_m0, .~.-(1|item)) 
nonefit_m2 <- glm(none_fits ~ conditions*dist, data = data_preprocessed_for_analysis_of_none_fit_huashan, family = binomial) 
summary(nonefit_m2)
anova(nonefit_mh1,nonefit_m2)
missing_dist <- which(is.na(data_preprocessed_for_analysis_of_none_fit_huashan$dist)==TRUE)
data_preprocessed_for_analysis_of_none_fit_huashan[missing_dist,]
#plot(allEffects(nonefit_m1))
