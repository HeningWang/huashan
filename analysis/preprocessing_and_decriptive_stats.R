library(tidyr)
library(ggplot2)
library(gridExtra)
library(trimr)
library(stringr)
library(lme4)

rm(list=ls())

plots_dir<- file.path(getwd(),"plots")
if(!dir.exists(plots_dir)) dir.create(plots_dir, recursive = TRUE, showWarnings = FALSE)

data <- read.csv(file = "../data/huashan.csv")
subj_info <-read.csv(file = "../data/huashan_subj_info.csv")


#do stuff with subj_info here:
#...


#subj_exp_condition<-subj_info[c("id","left.right")]

#head(data, n=5)


xtabs(~id, data=data)
xtabs(~id+conditions, data=data)#TODO: check
xtabs(~id+leftright_trial, data=data)#TODO: check
xtabs(~id+list, data=data)
round(xtabs(~list, data=data)/180)

#check missing slider values
xtabs(~id, data=data[is.na(data$list),])
xtabs(~id+conditions, data=data[is.na(data$list),])

xtabs(~conditions, data=data[data$item==1,])


xtabs(~id, data=data[complete.cases(data),])

#...
#data <- data[complete.cases(data),]

data$conditions <- droplevels(as.factor(data$conditions))
data$id <- droplevels(as.factor(data$id))
data$slider_value <- as.numeric(data$slider_value)

data <- merge(data,subj_exp_condition)

data$dist <- ifelse(data$list<4, "sharp", "blurred")

#TODO: analyze none fits...
data$none_fits <- ifelse(data$slider_value==-1, 1, 0)

#like so:
#glmer(none_fits ~ conditions + (1|id) + (1|item), data=data, family=binomial)


data$slider_value <- ifelse(data$slider_value==-1, NA, data$slider_value)


data <- subset(data, !is.na(data$slider_value))

#TODO: adjust later, rename variable
data$prefer_first_1st <- ifelse(data$leftright_trial=="1left", 100-data$slider_value, data$slider_value)

aggregate(data$prefer_first_1st, list(data$conditions), FUN = function(x){c(mean(x), sd(x)/sqrt(length(x)))})
aggregate(data$prefer_first_1st, list(data$conditions, data$dist), FUN = function(x){c(mean(x), sd(x)/sqrt(length(x)))})


#TODO: adjust later


data_filler <- subset(data, str_sub(data$conditions, 1, 1) == "f")

data <- droplevels(subset(data, str_sub(data$conditions, 1, 1) != "f"))

# 
# #exclude pps
# exclude<-NULL
# #TODO: adjust
# #exclude <- c()
# 
# data <- subset(data, !(id %in% exclude))

data$combination <- as.factor(ifelse(str_sub(data$conditions, 3, 4)=="cf", "color_form",
                           ifelse(str_sub(data$conditions, 3, 4)=="dc", "dimension_color",
                                  "dimension_form")))


data$relevant_property <- as.factor(ifelse(str_sub(data$conditions, 1, 1)== "e", "first",
                                           ifelse(str_sub(data$conditions, 1, 1)== "z", "second",
                                           "both")))
                                           


ratings_aggregated<-aggregate(prefer_first_1st~combination+relevant_property+dist, data=data, mean)
#TODO: find another way to compute ses (SEwithin?)
ses_ratings<-aggregate(prefer_first_1st~combination+relevant_property+dist, data=data, function(x) {sd(x)/sqrt(length(x))})
ratings_aggregated<-cbind(ratings_aggregated,ses_ratings[,4])

names(ratings_aggregated)[5]<-"se"


p <- ggplot(ratings_aggregated, aes(x=combination, y=prefer_first_1st, fill=relevant_property)) +
  geom_bar(stat="identity", position=position_dodge()) +
  geom_errorbar(aes(ymin=prefer_first_1st-se, ymax=prefer_first_1st+se), width=.2,
                position=position_dodge(.9))+
  facet_wrap(~dist)+
  scale_fill_brewer(palette="Paired") + theme_minimal()+
  theme(axis.text.x = element_text(angle = 45, hjust=1))
p
pdf(file = file.path(plots_dir,"mean_preference_facet.pdf"))
p
dev.off()
# 
# 
# data$relevant_prop <- ifelse(str_detect(data$conditions,"farbe"), "color", "size")
# 
# 
# m0 <- lmer(prefer_subj_1st~relevant_prop*sharpness+(1|id), data=data)
# summary(m0)
# 
# m1 <- update(m0, .~.-relevant_prop:sharpness)
#  
# anova(m0,m1)
# summary(m1)
# 
# # 
# # m2 <- update(m1, .~.-sharpness)
# # 
# # anova(m2,m1)
# # 
# # m3 <- update(m2, .~.-relevant_prop)
# # 
# # anova(m2,m3)
# # 
# # 
# # summary()
