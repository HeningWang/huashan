var randomized_maintrials = _.shuffle(maintrials)
//console.log(randomized_maintrials);
//select list
if (list==0){
	var selected_list = Math.floor(Math.random() * 3)+1;
} else {
	var selected_list = list;
}	
console.log("list: "+ selected_list);
//use all trials
//var all_stims = randomized_maintrials
//select one list
var all_stims = randomized_maintrials.filter(trial=>trial.list==selected_list);	

var in_lab = false;
var on_web = true;

function split_ino_blocks (total_number_of_trials) {
	var average_block_length = total_number_of_trials/4;
	var shift = Math.floor(Math.random() * Math.floor(Math.round(average_block_length/4)));
	shift*=Math.sign(Math.random()-0.5);
	var end_of_first_block = average_block_length + shift;
	var end_of_second_block = end_of_first_block + average_block_length - shift;
	var end_of_third_block = end_of_second_block + average_block_length + shift;
	return [Math.floor(end_of_first_block),Math.floor(end_of_second_block),Math.floor(end_of_third_block)];
}

var total_number_of_trials = all_stims.length;
var block_boundaries = split_ino_blocks(total_number_of_trials);
console.log("total length: "+all_stims.length);
console.log("block boundaries: "+ block_boundaries);


var stims_block1 = all_stims.slice(0, block_boundaries[0]);
console.log(stims_block1);
var stims_block2 = all_stims.slice(block_boundaries[0], block_boundaries[1]);
console.log(stims_block2);
var stims_block3 = all_stims.slice(block_boundaries[1],block_boundaries[2]);
console.log(stims_block3);
var stims_block4 = all_stims.slice(block_boundaries[2],total_number_of_trials);
console.log(stims_block4);

trainingtrials= randomized_maintrials.filter(trial=>trial.list==5);

randomized_trainingtrials = _.shuffle(trainingtrials);
//console.log(randomized_trainingtrials);

// character codes
//var CHAR = 75; // key k
//var CHAR_L = 74; // key j
//var CHAR_R = 76; // key l
var CHAR = 32; // space bar
var CHAR_L = 83; // key s
var CHAR_R = 76; // key l


function slide_builder(name, stims, feedback) {

	return slide({
		"name": name,

		present: stims,

		present_handle: function(stim) {

			this.stim = stim;
			
		    $(document).unbind('keydown');
			$(document).unbind('keyup');

		    function clearAll() {
			    $(".err").hide();
			    $(".right_response").hide();
			    $(".left_response").hide();
			    $(".display_condition").hide();
			    $(".image_display").hide();
				$(".slider").hide();
				$(".none_fits").hide();
				$(".checkbox_label").hide();
		    }

		    clearAll();
		    //TODO: make this an argument
		    //CHAR = 40; // down arrow
		    //press_and_hold(CHAR, display_one);
			var inter_trial_interval = 400;
			setTimeout(function(){	
				display_one(Date.now(),-1);
			}, inter_trial_interval);

			function mask (segment) {
				var split_segment = segment.split('');
				var masked = '';
				for (i = 0; i < split_segment.length; i++) {
					if (split_segment[i]==" ") {
						masked += " ";
					} else if (split_segment[i]==".") {
						masked += ".";
					} else if (split_segment[i]==",") {
						masked += ",";
					} else if (split_segment[i]=="+") {
						masked += "<br><br>";
					} else {
						masked += "-";
					}
				}
				return masked;
			}

		    function display_one(init_time,step) {
				
				clearAll();
				$(document).unbind('keydown');
			    $(document).unbind('keyup');
				
			    _s.image_error = false;
				var slider_moved = false;
				_s.slider_value = undefined;
				$('.none_fits').prop('checked', false);
				//console.log(_s.slider_value);
				var fname = "../pictures/" + "l" + stim.list + "pic" + stim.item + stim.condition + ".png"
				//var fname = "../pictures/" + "pic" + stim.item + ".png"
				var alt_text = "Image cannot be displayed."
				if (on_web) {
					alt_text += " Please check your internet connection."
				}
			    $(".image_display").html("<img id='image' src='"+fname+"' width='80%' alt='"+alt_text+"' onerror='_s.image_error = true;'/>");
				$(".image_display").show();
				
				var split = stim.context.split("*");
				var to_split = "Dies ist ein Testsatz." 
				var split = to_split.split("*");
				//TODO: add full stop
				for (j = 0; j < split.length; j++) {
					if (j!=step) {
						split[j] = mask(split[j]);
					} else {
						var str = split[j];
						split[j] = str.replace(/\+/g, "<br><br>");
					}
				}
				
				/*
				var joined = "<samp style=\"font-size:20;\">"+split.join(' ')+"</samp>";
				*/
				
				var joined = stim.context;
				
				if (step == -1) {
						_s.read_time = [];
				}

				$("img").load(function(){
					$(".display_condition").html(joined);
					$(".display_condition").show();				
					$(".slider").show();
					//var sentences = _.shuffle([stim.sentence1, stim.sentence2]);
					$(".right_response").html(exp.condition == "L" ? stim.sentence1 : stim.sentence2);//added after first bunch of participants 19 July 14:48
					$(".left_response").html(exp.condition == "L" ? stim.sentence2 : stim.sentence1);
					$(".right_response").show();
					$(".left_response").show();
					$(".none_fits").show();
					$(".checkbox_label").show();
				})	
				
				
				$(".slider").slider({
					start: function(event, ui) {
						//console.log("moved" + ui.value);
						slider_moved = true;
					},
					stop: function(event, ui) {
						//console.log("final value" + ui.value);
						_s.slider_value = ui.value;
						$(".err").hide();
					},
					value: 50
				});
				
				var checkboxState = null;
				

				$('.none_fits').click(function() {
					if (checkboxState === this) {
						checkboxState = null;
					} else {
						checkboxState = this;
					}
					this.blur();// unfocus checkbox
				});	
				
				
			    // record the initial time
			    // init_time = Date.now();
			    // listen for a space bar
			    $(document).keydown(function(event) {
				    if(event.which == CHAR) {
					    var rt = Date.now() - init_time; // in milliseconds
						_s.read_time.push(rt);
						//press_and_hold(CHAR, display_two);
						//clearAll();
						var inter_stimulus_interval = 0;
						//TODO: move timeout into else-body
						setTimeout(function(){
							if (step < split.length-2) {//used "-2" as we only want one display
								step++;
								display_one(Date.now(),step);
							} else if (!(slider_moved||checkboxState)) {
								$(".err").html("Bitte den Schieberegler berühren oder die Checkbox anklicken.");
								$(".err").show();
							} else {
								clearAll();	
								_s.slider_value = checkboxState ? -1 : _s.slider_value 
								$(".slider").slider('value', 50);
								_s.log_responses();
							}	
						}, inter_stimulus_interval);	
				    } else {
					    $(".err").html("Weiter mit der Leertaste.");
					    $(".err").show();
				    }
			    });
		    }

		},

		log_responses : function() {
			exp.data_trials.push({
				"item": this.stim.item,
				"conditions": this.stim.condition,
				"quant": this.stim.quantifier,
				"color": this.stim.color2_referent,
				"proportion": this.stim.ratio,
				"side": this.stim.order,
				"picture": this.stim.picture,
				"read_time": this.read_time,
				"pictureRT": this.pictureRT,
				"response": this.response,
				"correct_response": this.stim.correct_response,
				"image_error": this.image_error,
				"slider_value": this.slider_value,
			});
			// TODO: make sure we still have more trials, else call exp.go()
			if(_s.present.length > 0) {
				_stream.apply(this)
			} else{
				//end of block
				console.log("End of block")
				//$(document).unbind('keydown');
				exp.go();
			}
		}

	})
};

function make_slides(f) {
	var   slides = {};

	slides.i0 = slide({
		name : "i0",
		start: function() {
			exp.startT = Date.now();
		}
	});
	
	slides.consent =  slide({
		name : "consent",
		start : function(){},
		present : ['dummy'],
		present_handle : function() {
			$(".err").hide();
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
				$(".err").html("<b>Drücken Sie &quot;weiter&quot;, um fortzufahren!</b>");
				$(".err").show();
				}
			});
		},
		submit : function(e){
		  //if (e.preventDefault) e.preventDefault(); // I don't know what this means.
		  //TODO: MAKE CERTAIN ONES REQUIRED
			$(".err").hide();
			if($("input:checkbox[name=checkbox]:checked").length < $("input:checkbox[name=checkbox]").length) {
				$(".err").html("<b>Das Experiment kann erst begonnen werden, wenn alle obigen Punkte angekreuzt wurden.</b>");
				$(".err").show();
			} else {
				exp.go(); //use exp.go() if and only if there is no "present" data.
			}
	    }
	});
	
	slides.debriefing_info =  slide({
		name : "debriefing_info",
		start : function(){},
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
					exp.go();
				}
			});
		},
	});

	slides.instructions0 = slide({
		name : "instructions0",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$("#true_button0").html(exp.condition);
			$("#false_button0").html(exp.condition == "S" ? "L" : "S");
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
					exp.go();
				}
			});
		}
	/*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

	slides.instructions = slide({
		name : "instructions",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$("#true_button").html(exp.condition);
			$("#false_button").html(exp.condition == "S" ? "L" : "S");
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
					exp.go();
				}
			});
		}
	/*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

  

	slides.training = slide_builder("training", randomized_trainingtrials,
		false);
  


	slides.begin_slide = slide({
		name : "begin_slide",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
					exp.go();
				}
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

  
	slides.single_trial_first_block = slide_builder("single_trial_first_block", stims_block1, false);
	slides.single_trial_second_block = slide_builder("single_trial_second_block", stims_block2, false);
	slides.single_trial_third_block = slide_builder("single_trial_third_block", stims_block3, false);
	slides.single_trial_fourth_block = slide_builder("single_trial_fourth_block", stims_block4, false);


	slides.begin_break_one = slide({
		name : "begin_break_one",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				} else {
					exp.break_one_missed=true;
				}
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

	slides.end_break_one = slide({
		name : "end_break_one",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				}
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

	slides.begin_break_two = slide({
		name : "begin_break_two",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				} else {
					exp.break_two_missed=true;
				}
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

	slides.end_break_two = slide({
		name : "end_break_two",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				}
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});
  
	slides.begin_break_three = slide({
		name : "begin_break_three",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				} else {
					exp.break_three_missed=true;
				}		
			});
		}
	  /*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});

	slides.end_break_three = slide({
		name : "end_break_three",
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == 66) {
					exp.go();
				}
			});
		}
	/*
    button : function() {
      exp.go(); //use exp.go() if and only if there is no "present" data.
    }
    */
	});



	slides.subj_info =  slide({
		name : "subj_info",
		start : function(){},
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
			$(document).keydown(function(event) {
				if(event.which == CHAR) {
				$(".err").html("<b>Use &quot;Submit&quot; button to advance!</b>");
				$(".err").show();
				}
			});
		},
		submit : function(e){
      //if (e.preventDefault) e.preventDefault(); // I don't know what this means.
	  //TODO: MAKE CERTAIN ONES REQUIRED
		$(".err").hide();
		if($("#language").val() == "" || $("#prolific_id").val() == "") {
			//if($("#language").val() == "") {
			//if($("#age").val() == "" || $("#gender").val() == "" || $("#language").val() == "") {
			//if($("#age").val() == "" || $("#gender").val() == "" || $("#language").val() == "" || $("#education").val() == -1) {
			$(".err").html("<b>Please provide required information.</b>");
			$(".err").show();
		} else {
			exp.subj_data = {
				language : $("#language").val(),
				//enjoyment : $("#enjoyment").val(),
				asses : $('input[name="assess"]:checked').val(),
				age : $("#age").val(),
				gender : $("#gender").val(),
				//education : $("#education").val(),
				comments : $("#comments").val(),
				// problems: $("#problems").val(),
				//fairprice: $("#fairprice").val(),
				fluent: $('input[name="fluent"]:checked').val(),
				prolific_id: $("#prolific_id").val(),
			};
			exp.go(); //use exp.go() if and only if there is no "present" data.
		}
		}
	});

	slides.thanks = slide({
		name : "thanks",
		start : function() {
			exp.data= {
				"trials" : exp.data_trials,
				"id" : exp.id,
				"catch_trials" : exp.catch_trials,
				"block_boundaries" : block_boundaries,
				"system" : exp.system,
				"condition" : exp.condition,
				"subject_information" : exp.subj_data,
				"time_in_minutes" : (Date.now() - exp.startT)/60000,
				"missed_break_one" : exp.break_one_missed,
				"missed_break_two" : exp.break_two_missed,
				"missed_break_three" : exp.break_three_missed
			};
			$(".complete").hide();
			$(".click_complete").hide();
			$(".debriefing").hide();
			$(".err").html("<b>Please wait!</b>");
			$(".err").show();
			save_data(exp.data);
		},
		present : ['dummy'],
		present_handle : function() {
			$(document).unbind('keydown');
			$(document).unbind('keyup');
		},
	});
  
	return slides;
}

function save_data (data) {
	//save data...
	//...on the web
	if (on_web) {	
		postAjax('https://www.lingexp.uni-tuebingen.de/b1/huashan/save_data.php',
					{ json: JSON.stringify(data)},
					show_completion_link
		);	
		console.log("posted");
	}	
	//...in the lab
	if (in_lab) {	
		var save_in_lab = (function () {
			var a = document.createElement("a");
			document.body.appendChild(a);
			a.style = "display: none";
			return function (data, fileName) {
				var json = JSON.stringify(data),
				blob = new Blob([json], {type: "octet/stream"}),
				url = window.URL.createObjectURL(blob);
				a.href = url;
				a.download = fileName;
				a.click();
				window.URL.revokeObjectURL(url);
			};
		}());
		var id = uniqid("pfaender_");
		file_name = "results_"+id+".json";
		save_in_lab(data, file_name);	
		show_done();
		//Todo: PSI only
		show_completion_link();
	}
}

function show_completion_link () {
	setTimeout(function(){
				show_done();
				$(".click_complete").show();
				var completion_code;
				get_completion_link("https://www.lingexp.uni-tuebingen.de/b1/huashan/completion_link.php", function(data){
					completion_code = data;
					$(".complete").attr("href", "https://app.prolific.co/submissions/complete?cc=" + data)
					$(".complete").html("Completion code: " + data);
					//PSI only
					//$(".complete").attr("href", "mailto:experimente-b8@sfb833.uni-tuebingen.de?subject=Teilnahme%20" + exp.id);
					//$(".complete").html("Teilnahme-Code: " + exp.id);
					$(".complete").show();
					//$(".debriefing").html("Code für <a href=\"Debriefing_Public_encrypted.pdf\" target =\"_blank\">Debriefing-Dokument</a>: " + data);
					//$(".debriefing").show();
					console.log("got"+data);
					console.log(data);
				});				
	},500)
}

function show_done () {
		$(".err").html("<b>Das Experiment ist zu Ende!</b>");
		$(".err").show();
}

function uniqid(a = "",b = false){
    var c = Date.now()/1000;
    var d = c.toString(16).split(".").join("");
    while(d.length < 14){
        d += "0";
    }
    var e = "";
    if(b){
        e = ".";
        var f = Math.round(Math.random()*100000000);
        e += f;
    }
    return a + d + e;
}

function postAjax(url, data, success) {
	var params = typeof data == 'string' ? data : Object.keys(data).map(
		function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
	).join('&');
	var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	//var xhr = new XMLHttpRequest();
	xhr.open('POST', url);
	xhr.onreadystatechange = function() {
		if (xhr.readyState>3 && xhr.status==200) { success(); } 
	};
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send(params);
	return xhr;
}

function get_completion_link(url, success) {
	var xhr1 = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	//var xhr = new XMLHttpRequest();
	xhr1.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { console.log("success"); success(this.responseText); } 
	};
	xhr1.open('GET', url);
	xhr1.send();
	return xhr1;
}
	
/// init ///
function init() {
	exp.trials = [];
	exp.catch_trials = [];
	exp.id = uniqid();
	// TODO: condition for Y/N response key?
	exp.condition = _.sample(["S", "L"]); //can randomize between subject conditions here
	exp.block_boundaries = block_boundaries; 
	exp.break_one_missed = false;
	exp.break_two_missed = false;
	exp.break_three_missed = false;
	exp.system = {
		Browser : BrowserDetect.browser,
		OS : BrowserDetect.OS,
		screenH: screen.height,
		screenUH: exp.height,
		screenW: screen.width,
		screenUW: exp.width
    };
	//blocks of the experiment:
    //TODO: Find better ways of blocking?
	//exp.structure=["i0",  "instructions0", "instructions", "training",  "begin_slide", "single_trial_first_block", "begin_break_one", "end_break_one", "single_trial_second_block", "begin_break_two", "end_break_two", "single_trial_third_block", "begin_break_three", "end_break_three", "single_trial_fourth_block", 'subj_info', 'thanks'];
    //exp.structure=["i0","instructions0", "instructions", "training", "begin_slide", "single_trial_first_block", "begin_break_one", "end_break_one", "single_trial_second_block", "begin_break_two", "end_break_two", "single_trial_third_block", "begin_break_three", "end_break_three", "single_trial_fourth_block", 'subj_info', 'thanks'];
	//exp.structure=["i0", "consent", "debriefing_info", "instructions0", "instructions", "training", "begin_slide", "single_trial_first_block", "begin_break_one", "end_break_one", "single_trial_second_block", "begin_break_two", "end_break_two", "single_trial_third_block", "begin_break_three", "end_break_three", "single_trial_fourth_block", 'subj_info', 'thanks'];
	exp.structure=["i0", "consent", "debriefing_info", "instructions0", "instructions", "training", "begin_slide", "single_trial_first_block", "begin_break_one", "end_break_one", "single_trial_second_block", "begin_break_two", "end_break_two", "single_trial_third_block", "begin_break_three", "end_break_three", "single_trial_fourth_block", 'subj_info', 'thanks'];
	//exp.structure=["i0", "begin_slide", "single_trial_first_block", "begin_break_one", "end_break_one", 'subj_info', 'thanks'];
	
	
	exp.data_trials = [];
	//make corresponding slides:
	exp.slides = make_slides(exp);

	exp.nQs = utils.get_exp_length(); //this does not work if there are stacks of stims (but does work for an experiment with this structure)
                    //relies on structure and slides being defined

	$('.slide').hide(); //hide everything
	
	var elem = document.documentElement;

	//make sure turkers have accepted HIT (or you're not in mturk)
	  //TODO: replace Start button with space bar?
	$("#start_button").click(function() {
		if (turk.previewMode) {
			$("#mustaccept").show();
		} else {
			$("#start_button").click(function() {$("#mustaccept").show();});
			if (elem.requestFullscreen) {
				elem.requestFullscreen();
			} else if (elem.mozRequestFullScreen) { /* Firefox */
				elem.mozRequestFullScreen();
			} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
				elem.webkitRequestFullscreen();
			} else if (elem.msRequestFullscreen) { /* IE/Edge */
				elem.msRequestFullscreen();
			}
			exp.go();
		}
	});

	exp.go(); //show first slide
	  // TODO: advance instructions with space bar, not clicking
	  // TODO: error messages when listening to keys [including proper display]
}