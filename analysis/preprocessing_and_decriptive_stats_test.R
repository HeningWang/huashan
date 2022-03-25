library(tidyr)
library(ggplot2)
library(gridExtra)
library(trimr)
library(stringr)
library(lme4)
library(data.table)

rm(list=ls())

# set up dir for plotting
plots_dir<- file.path(getwd(),"plots")
if(!dir.exists(plots_dir)) dir.create(plots_dir, recursive = TRUE, showWarnings = FALSE)

# import raw data from .csv
data_raw <- read.csv(file = "../data/huashan.csv")
subj_info <-read.csv(file = "../data/huashan_subj_info.csv")


#do stuff with subj_info here:
#...


subj_exp_condition<-subj_info[c("id","left.right")]

# get some general view of raw data
head(data_raw, n=5)
#show how many pps
sum(xtabs(~id, data = subj_info))

# show if every images are properly displayed
xtabs(~image_error, data=data_raw)

# show how many trials one pp has done (exp. 180)
xtabs(~id, data=data_raw)
# ... and how many of them are completed (no NA)
xtabs(~id, data=data_raw[complete.cases(data_raw),])

# show which and how many conditions one pp has done (exp. 9 trials for 9 conditions)
xtabs(~id+conditions, data=data_raw)
#data <- data[complete.cases(data),]

# show which pp has done which list
xtabs(~conditions+item, data=data_raw[data_raw$item==1,])
xtabs(~id+item, data=data_raw)

# TODO: order data in lists and size distribution
# with only item cannot specity which distribution, but wihtin one distribution, we can infer list from item




# set up factors and normalize numerical values
data_exp <- copy(data_raw)
data_exp$conditions <- droplevels(as.factor(data_exp$conditions))
data_exp$id <- droplevels(as.factor(data_exp$id))
data_exp$slider_value <- as.numeric(data_exp$slider_value)
data_exp <- merge(data_exp,subj_exp_condition)
data_exp$prefer_adj_1st <- ifelse(data_exp$left.right=="S", 100-data_exp$slider_value,data_exp$slider_value)

#subset data into filler and experimental items
data_filler <- subset(data_exp, conditions %in% c("ferdc", "ferdf", "fercf","fzrdc", "fzrdf", "fzrcf", "fbrdc", "fbrdf", "fbrcf"))
data_exp <- subset(data_exp, conditions %in% c("erdc", "erdf", "ercf","zrdc", "zrdf", "zrcf", "brdc", "brdf", "brcf"))


# TODO: show how many experiment items are responsed with -1
which(data_exp$prefer_adj_1st == -1)

# TODO: add exclude criteria here
# exclude<-NULL
# #TODO: adjust
# #exclude <- c()
# 
# data <- subset(data, !(id %in% exclude))
#           
# aggregate(data$prefer_subj_1st, list(data$conditions), 
#           FUN=function(x){c(mean(x, na.rm = TRUE),sd(x, na.rm = TRUE)/sqrt(length(x)))})
# 
# 
# ratings_aggregated<-aggregate(prefer_subj_1st~conditions, data=data, mean)
# #TODO: find another way to compute ses (SEwithin?)
# ses_ratings<-aggregate(prefer_subj_1st~conditions, data=data, function(x) {sd(x)/sqrt(length(x))})
# ratings_aggregated<-cbind(ratings_aggregated,ses_ratings[,2])
# 
# names(ratings_aggregated)<-c("condition", "prefer_subj_1st", "se")
# 
# 
# p <- ggplot(ratings_aggregated, aes(x=condition, y=prefer_subj_1st, fill=condition)) + 
#   geom_bar(stat="identity", position=position_dodge()) +
#   geom_errorbar(aes(ymin=prefer_subj_1st-se, ymax=prefer_subj_1st+se), width=.2,
#                 position=position_dodge(.9))
# 
# #p + scale_fill_brewer(palette="Paired") + theme_minimal()            
# p
# pdf(file = file.path(plots_dir,"mean_preference.pdf"))
# p
# dev.off()
# 
# 
# data$relevant_prop <- ifelse(str_detect(data$conditions,"farbe"), "color", "size")
# 
# data$sharpness <- ifelse(str_detect(data$conditions,"un"), "low", "high")
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
