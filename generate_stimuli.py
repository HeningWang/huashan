import json
import csv
#import sys

#read csv file as list of lists of strings
with open('stimuli_table.csv', 'r', encoding='utf-8') as f:
    reader = csv.reader(f)

    #skip header
    next(reader, None)
    stimuli_file = list(reader)
    #print(stimuli_file)

#Filter for relevant lines
def relevant_line(line):
    return True



#create dict with relevant data
def create_dict(line):
    line_string = ";".join(str(x) for x in line)
    line_cells = line_string.split(";")    
    return {"condition": line_cells[3],
            "list": line_cells[0],
            "context": line_cells[30],			
            "sentence1": line_cells[28],
            "sentence2": line_cells[29],
			"sharpness": line_cells[31],
			"item": line_cells[2]}





# list of lists
trial_lines_list = list(filter(relevant_line, stimuli_file))

trial_dicts_list = list(map(create_dict, trial_lines_list))
print(trial_dicts_list)

print("total number of trials: "+str(len(trial_dicts_list)))

trials = json.dumps(trial_dicts_list, ensure_ascii=False)

out = "const maintrials ="+trials

out_unicode = out.encode("utf8")

#save file as stimuli.js
f = open("web\js\stimuli.js","wb")
f.write(out_unicode)
f.close()



