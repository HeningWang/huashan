input <- read.csv("Tabelle_neuesFormat_mitKontext_mitFillern_final2.csv")

(input$Condition <- as.factor(input$Condition))
  
sizes_grosse_scharf <- subset(input, Condition=="grosse_scharf")[4:9]
sizes_farbe_unscharf <- subset(input, Condition=="farbe_unscharf")[4:9]
sizes_grosse_unscharf <- subset(input, Condition=="grosse_unscharf")[4:9]
sizes_farbe_scharf <- subset(input, Condition=="farbe_scharf")[4:9]

y<-function(x){sort(x, decreasing = TRUE)}

pdf(file="dists.pdf", height = 4, width = 4)
par(mfrow=c(2,2))
plot(1:6,y(sizes_grosse_scharf[1,]), lty=1)
apply(sizes_grosse_scharf, 1, function (x) {lines(1:6,y(x), lty=1, col=as.integer(runif(1,1,15)))})
plot(1:6,y(sizes_farbe_unscharf[1,]), lty=1)
apply(sizes_farbe_unscharf, 1, function (x) {lines(1:6,y(x), lty=1, col=as.integer(runif(1,1,15)))})
plot(1:6,y(sizes_grosse_unscharf[1,]), lty=1)
apply(sizes_grosse_unscharf, 1, function (x) {lines(1:6,y(x), lty=1, col=as.integer(runif(1,1,15)))})
plot(1:6,y(sizes_farbe_scharf[1,]), lty=1)
apply(sizes_farbe_scharf, 1, function (x) {lines(1:6,y(x), lty=1, col=as.integer(runif(1,1,15)))})
par(mfrow=c(1,1))
dev.off()


