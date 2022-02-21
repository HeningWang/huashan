<html>
<meta charset="utf-8"/>
<head>
    <title>Pfaender</title>

    <!--JS-->

    <!-- external general utilities -->
    <script src="../_shared/js/jquery-1.11.1.min.js "></script>
    <script src="../_shared/full-projects/jquery-ui/jquery-ui.min.js"></script>
    <script src="../_shared/js/underscore-min.js"></script>
    <!-- if you want to draw stuff: -->
    <!-- <script src="../_shared/js/raphael-min.js"></script> -->

    <!-- cocolab experiment logic -->
    <script src="../_shared/js/exp-V2.js"></script>
    <script src="../_shared/js/stream-V2.js"></script>

    <!-- cocolab general utilities -->
    <script src="../_shared/js/mmturkey.js "></script>
    <script src="../_shared/js/browserCheck.js"></script>
    <script src="../_shared/js/utils.js"></script>
    <!-- if you want to draw cute creatures (depends on raphael): -->
    <!-- <script src="../_shared/js/ecosystem.js"></script> -->

    <!-- experiment specific helper functions -->
    <!-- <script src="js/local-utils.js"></script> -->

    <!--CSS-->
    <link href="../_shared/full-projects/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="../_shared/css/cocolab-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/local-style.css" rel="stylesheet" type="text/css"/>

	<!-- stimuli file -->
    <script src="js/stimuli.js" charset="UTF-8"></script>
	
	<!-- get list from url parameter -->
	<!--<script type="text/javascript">
      var list = <?php if(isset($_GET["l"])) {
				$l = htmlspecialchars($_GET["l"]);
				} else {
				$l = 0;
				}
				echo $l;
			 ?>;
    </script>-->
	<script type="text/javascript">
		var list = 1;
	</script>	

    <!-- experiment file -->
    <script src="js/experiment.js"></script>

</head>
<body onload="init();">
  <noscript>This task requires JavaScript.</noscript>

  <div class="slide" style="height:600" id="i0" >
   <p id="cocolab">Teilnahmeinformationen zur Studie Pfaender</p>
    <p id="instruct-text">Liebe Teilnehmerin, lieber Teilnehmer,<br><br> vielen Dank, dass Sie an dieser Studie teilnehmen, die wir im Rahmen eines Seminars der Germanistischen Linguistik an der Universität Tübingen durchführen! Hier erhalten Sie vorab einige Informationen zur Studie.</p>
	<p>In diesem Experiment geht es darum, zwischen mehr oder weniger passenden Beschreibungen von abgebildeten Objekten abzuwägen. </p>
	<p id="legal"><b>Ablauf der Studie</b>: Es wird insgesamt 60 Durchgänge geben, die in vier Blöcke aufgeteilt sind. Zwischen den Blöcken können Sie pausieren. Das Ausfüllen des Fragebogens wird ca. 20 Minuten in Anspruch nehmen. 
	Am Ende dieses Fragebogens erheben wir einige freiwillige persönliche Daten. Sollten Sie diese Angaben nicht machen wollen, können Sie alle Fragen bis auf die Frage nach Ihrer Muttersprache offenlassen. </p>
	<p id="legal"><b>Datenschutz &amp; Freiwilligkeit</b>: Die Teilnahme an dieser Studie ist freiwillig und anonym. Ein Rückschluss der Untersuchungsergebnisse auf Ihre Person ist nicht möglich. Alle erhobenen Daten werden ausschließlich zum Zweck der wissenschaftlichen Studie gespeichert und werden nicht an Dritte weitergeleitet. Sie können das Experiment, bis Sie den letzten Button, „Experiment beenden“, betätigen, jederzeit und ohne Angabe von Gründen abbrechen, ohne dass Ihnen daraus Nachteile entstehen. Ihre Daten werden dann nicht gespeichert. Sie haben dann trotzdem für die bis dahin vergangene Zeit Anspruch auf eine entsprechende Kompensation. Falls Sie frühzeitig abbrechen sollten, haben Sie folglich die Möglichkeit, uns zu kontaktieren, um (i) eine teilweise Entschädigung zu bekommen und (ii) ein Debriefing mit einer Erklärung unserer Forschungsfragen und Methoden zu erhalten. In diesem Fall kontaktieren Sie bitte den Studienleiter (Fabian Schlotterbeck, Email-Adresse:  fabian.schlotterbeck@uni-tuebingen.de).</p>
	<!--is the following needed-->
	<!--<p id="instruct-text">Mit dem Drücken der folgenden Taste versichern Sie, dass Sie die oben beschriebenen Teilnehmerinformationen verstanden haben und mit den genannten Teilnahmebedingungen einverstanden sind.</p>-->
	<button id="start_button">Weiter</button>
  </div>
  
  <div class="slide"  id="consent" style="padding-top:90px">
    <div class="long_form">
      <div class="consent_title"><h3>Einwilligungserklärung zur Studie Pfaender</h3></div>
	  <div class="optionset" id="optionset" style="text-align: left;">
		<input type="checkbox" id="checkbox1" name="checkbox" class="option" value="1">
		<label class="option_label" id="checkbox1_label" for="checkbox1" name="checkbox_label">Ich bin schriftlich über das Experiment und den Versuchsablauf aufgeklärt worden. Ich habe alle Informationen vollständig gelesen und verstanden.</label><br>
		<input type="checkbox" id="checkbox2" name="checkbox" class="option" value="2">
		<label class="option_label" id="checkbox2_label" for="checkbox2" name="checkbox_label">Ich bin mit der in den Teilnahmeinformationen beschriebenen Handhabung der Daten einverstanden. Die Speicherung der Daten erfolgt ausschließlich vollständig anonym auf einem Server der Universität Tübingen. Die Daten werden zudem als offene Daten vollständig anonym im Internet in einem Datenarchiv zur Verfügung gestellt.</label>
		<input type="checkbox" id="checkbox3" name="checkbox" class="option" value="3">
		<label class="option_label" id="checkbox3_label" for="checkbox3" name="checkbox_label">Ich weiß, dass die Teilnahme freiwillig ist und dass ich mein Einverständnis auch während des Experiments jederzeit vor Betätigen des letzten Buttons „Experiment beenden“ ohne Angabe von Gründen abbrechen kann, was dazu führt, dass meine Daten nicht gespeichert werden. Ich weiß, dass ich in diesem Fall Anspruch auf eine teilweise Vergütung habe. Sobald ich auf den Button „Experiment beenden“ geklickt habe, werden meine Daten in anonymisierter Form an einen Server der Universität Tübingen gesendet und dort gespeichert.</label><br>
		<input type="checkbox" id="checkbox4" name="checkbox" class="option" value="4">
		<label class="option_label" id="checkbox4_label" for="checkbox4" name="checkbox_label">Meine Daten werden nach Beenden des Experiments anonym gespeichert und sind nicht mehr identifizierbar. Ich kann daher nach Beenden des Experiments keine Löschung meiner Daten mehr verlangen.</label><br>
		<input type="checkbox" id="checkbox5" name="checkbox" class="option" value="5">
		<label class="option_label" id="checkbox5_label" for="checkbox5" name="checkbox_label">Ich bin damit einverstanden, dass meine anonymen Daten zu Forschungszwecken weiterverwendet werden können und mindestens zehn Jahre gespeichert werden.</label><br>
		<input type="checkbox" id="checkbox6" name="checkbox" class="option" value="6">
		<label class="option_label" id="checkbox6_label" for="checkbox6" name="checkbox_label">Ich hatte genügend Zeit für eine Entscheidung und bin einverstanden, an dem Lesezeitexperiment teilzunehmen.</label><br>
	  </div>
	  <button onclick="_s.submit()">Weiter</button>
	  <p class="err">{{}}</p>
    </div>
  </div>
  
  <div class="slide"  id="debriefing_info">
	<div><h3>Rückmeldung von Ergebnissen</h3></div>
	<p id="legal">Die Untersuchung dient nicht der psychologischen Diagnostik. Es werden Ihnen keine individuellen Testergebnisse mitgeteilt. Auf Wunsch können wir Sie über die allgemeinen Ergebnisse dieser Studie informieren. Wenn Sie an den allgemeinen Ergebnissen dieser Studie interessiert sind, dann senden Sie bitte eine E-Mail an fabian.schlotterbeck@uni-tuebingen.de.</p>
	<p id="legal">Bei Fragen oder anderen Anliegen können Sie sich an folgende Personen wenden:</p>
	<p>
		<table style="width:100%; border: 1px solid black;">
		  <tr>
			<td>Versuchsleiter: Fabian Schlotterbeck</td>
			<td>Projektleiterin: Polina Berezovskaya</td>
		  </tr>
		  <tr>
			<td><i>Universität Tübingen</i></td>
			<td><i>Universität Tübingen</i></td>
		  </tr>
		  <tr>
			<td><i>Philosophische Fakultät, Deutsches Seminar, Linguistische Abteilung</i></td>
			<td><i>Philosophische Fakultät, Englisches Seminar, English Linguistics</i></td>
		  </tr>
		  <tr>
			<td><i>Wilhelmstraße 50, Raum 448 </i></td>
			<td><i>Wilhelmstraße 50, Raum 464 </i></td>
		  </tr>
		  <tr>
			<td><code>fabian.schlotterbeck@uni-tuebingen.de</code></td>
			<td><code>polina.berezovskaya@uni-tuebingen.de</code></td>
		  </tr>
		  <tr>
			<td><code>07071 29 76740 </code></td>
			<td><code>07071 29 74280</code></td>
		  </tr>
		</table> 
	</p>
	<p><b>Drücken Sie jetzt die LEERTASTE</b>, um zu den Instruktionen zu gelangen.</p>
  </div>

  <div class="slide" id="instructions0" style="padding-top:60px">
    <h3>Instruktion</h3>
	<p><b>Instruktion</b>: In diesem Experiment geht es darum, zwischen mehr oder weniger passenden Beschreibungen von abgebildeten Objekten abzuwägen. Konkret geht es um das folgende Szenario: Zwei befreundete Personen öffnen mehrere Sets bestimmter Sammelkarten und tauschen sich am Telefon darüber aus. Die Sammelkarten sehen unscheinbar aus, sind aber in bestimmten Kreisen extrem angesagt. Jedes Set enthält sechs Karten mit einfachen Abbildungen. Im Folgenden wird eine der beiden Personen der anderen jeweils mitteilen, welche Karte aus dem jeweiligen Set sie besonders mag. Ihnen werden die sechs Karten der Sprecherin bzw. des Sprechers zusammen mit zwei mögliche Äußerungen gezeigt. Beide Äußerungen könnten von der Sprecherin oder dem Sprecher gewählt werden, um Bezug auf eine entsprechend hervorgehobene Karte zu nehmen, die ihr bzw. ihm besonders gefällt. Ihre Aufgabe wird sein, anhand eines Schiebereglers anzuzeigen, welche Äußerung passender wäre, um sich auf die markierte Karte zu beziehen. Falls beide möglich sind und die Entscheidung nicht ganz klar ist, geben Sie bitte Ihre Tendenz an. Falls Sie meinen, dass keine der beiden Äußerungen passt, können Sie dies ebenfalls anzeigen.</p>
	<p>Sie sehen immer nur die Karten der einen Person. Beide Personen haben in jedem Durchgang dieselben Kartensets vor sich und sie beziehen sich auf die Eigenschaften der Abbildungen auf den Karten. Da die räumliche Anordnung der Karten zwischen den Gesprächspartnern abweichen kann, ist die Position der Karten grundsätzlich keine Option, sich auf Karten zu beziehen. </p>
    <p><b>Drücken Sie jetzt die LEERTASTE</b>, um weiter zu kommen.</p>
  </div>
  
  <div class="slide" id="instructions" style="padding-top:60px">
	<p>Gleich geht's los.</p>
    <p>Denken Sie daran: Es geht darum, zu bewerten welche Aussage passender ist, um die hervorgehobene Lieblingskarte im jeweiligen Kartenset zu beschreiben.</p>
	<p>Nachdem Sie ihre Bewertung mit Hilfe des Schieberglers angegeben haben, kommen Sie per Druck der <b>Leertaste</b> zum nächsten Durchgang.</p>
	<p><b>Drücken Sie jetzt die LEERTASTE</b>, um einen kurzen Übungsblock zu beginnen.</p>
  </div>

  <div class="slide" id="training">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<div class="slider" style="width:30%; left:35%"></div>
	<label class="checkbox_label"><input type="checkbox" class="none_fits" value="none fits" />Keine Beschreibung passt.</label>
    <p class="err">{{}}</p>
  </div>
  

    <div class="slide" id="begin_slide">
    <h3>Los geht's!</h3>
    <p>Sehr gut! Nachdem Sie Sich nun mit dem Ablauf vertraut gemacht haben, kann's losgehen!</p>
    <p><b>Drücken Sie die Leertaste</b>, um den ersten Durchgang des Experiments zu starten!</p>
  </div>   
  
  <div class="slide" id="single_trial_first_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<div class="slider" style="width:30%; left:35%"></div>
	<label class="checkbox_label"><input type="checkbox" class="none_fits" value="none fits" />Keine Beschreibung passt.</label>
    <p class="err">{{}}</p>
  </div>
  
  <div class="slide" id="begin_break_one">
    <p style="margin-top: 180px;">Bitte drücken Sie B, um die erste Pause zu beginnen.</p>
  </div>

  <div class="slide" id="end_break_one">
    <p style="margin-top: 130px;">Sie können jetzt pausieren.</p>
	<p>Wenn Sie bereit für den nächsten Block sind, <b>drücken Sie B</b>, um ihn zu beginnen.</p> 
	<p>Denken Sie daran: Es geht darum zu bewerten, welche Aussage passender ist, um die hervorgehobene Lieblingskarte im jeweiligen Kartenset zu beschreiben.</p>
  </div>
  
  <div class="slide" id="single_trial_second_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<div class="slider" style="width:30%; left:35%"></div>
	<label class="checkbox_label"><input type="checkbox" class="none_fits" value="none fits" />Keine Beschreibung passt.</label>
    <p class="err">{{}}</p>
  </div>

  <div class="slide" id="begin_break_two">
    <p style="margin-top: 180px;">Bitte drücken Sie B, um die zweite Pause zu beginnen.</p>
  </div>

  <div class="slide" id="end_break_two">
	<p style="margin-top: 130px;">Sie können jetzt pausieren.</p>
	<p>Wenn Sie bereit für den nächsten Block sind, <b>drücken Sie B</b>, um ihn zu beginnen.</p> 
	<p>Denken Sie daran: Es geht darum zu bewerten, welche Aussage passender ist, um die hervorgehobene Lieblingskarte im jeweiligen Kartenset zu beschreiben.</p>
  </div>
  
  <div class="slide" id="single_trial_third_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<div class="slider" style="width:30%; left:35%"></div>
	<label class="checkbox_label"><input type="checkbox" class="none_fits" value="none fits" />Keine Beschreibung passt.</label>
    <p class="err">{{}}</p>
  </div>
  
  <div class="slide" id="begin_break_three">
    <p style="margin-top: 180px;">Bitte drücken Sie B, um die dritte Pause zu beginnen.</p>
  </div>

  <div class="slide" id="end_break_three">
	<p style="margin-top: 130px;">Sie können jetzt pausieren.</p>
	<p>Wenn Sie bereit für den nächsten Block sind, <b>drücken Sie B</b>, um ihn zu beginnen.</p> 
	<p>Denken Sie daran: Es geht darum zu bewerten, welche Aussage passender ist, um die hervorgehobene Lieblingskarte im jeweiligen Kartenset zu beschreiben.</p>

  </div>

  
  <div class="slide" id="single_trial_fourth_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<div class="slider" style="width:30%; left:35%"></div>
	<label class="checkbox_label"><input type="checkbox" class="none_fits" value="none fits" />Keine Beschreibung passt.</label>
    <p class="err">{{}}</p>
  </div> 

  <div class="slide"  id="subj_info">
    <div class="long_form">
      <div class="subj_info_title">Zusätzliche Informationen</div>
      <p>Haben Sie die Instruktionen gelesen und die Aufgabe wie dort beschrieben bearbeitet?</p>
      <label><input type="radio"  name="assess" value="No"/>Nein</label>
      <label><input type="radio"  name="assess" value="Yes"/>Ja</label>
      <label><input type="radio"  name="assess" value="Confused"/>Ich bin mir unsicher</label>

      <!--
      <p>Were there any problems or bugs in the experiment?</p>
      <textarea id="problems" rows="2" cols="50"></textarea>
      -->

      <!--<p>What do you think is a fair price for the work you did?</p>
      <textarea id="fairprice" rows="1" cols="10"></textarea>-->

      <p>Geschlecht:
        <select id="gender">
          <label><option value=""/></label>
          <label><option value="Male"/>männlich</label>
          <label><option value="Female"/>weiblich</label>
          <label><option value="Other"/>divers</label>
        </select>
      </p>

      <p>Alter: <input type="text" id="age"/></p>

      <!--<p>Level Of Education (required):
        <select id="education">
          <label><option value="-1"/></label>
          <label><option value="0"/>Some High School</label>
          <label><option value="1"/>Graduated High School</label>
          <label><option value="2"/>Some College</label>
          <label><option value="3"/>Graduated College</label>
          <label><option value="4"/>Hold a higher degree</label>
        </select>
      </p>-->

      <p>Muttersprache(n) (erforderlich): <input type="text" id="language"/></p>
      <label>(die Sprache(n), die in Ihrer Kindheit zu Hause gesprochen wurde(n))</label>
	  
	  <!--<p>Prolific ID (required):<input type="text" id="prolific_id"/></p>-->

      <p>Sprechen Sie mehr als eine Sprache fließend?</p>
      <label><input type="radio"  name="fluent" value="No"/>Nein</label>
      <label><input type="radio"  name="fluent" value="Yes"/>Ja</label>

      <!--<p>Did you enjoy the hit?</p>
      <select id="enjoyment">
        <label><option value="-1"></option></label>
        <label><option value="0">Worse than the Average HIT</option></label>
        <label><option value="1" >An Average HIT</option></label>
        <label><option value="2">Better than average HIT</option></label>
      </select>-->

      <p> Wenn Sie möchten, können Sie hier Kommentare zum Experiment eingeben:</p>
      <textarea id="comments" rows="3" cols="50"></textarea>
      <br/>
	  <p>Alle Angaben außer Muttersprache sind optional.</p>
      <button onclick="_s.submit()">Experiment beenden</button>
	  <p class="err">Sie müssen Ihre Muttersprache angeben.</p>
    </div>
  </div>

  <div id="thanks" class="slide js" >
    <p class="err"></p>
    <p class="big">Danke für Ihre Teilnahme!</p>
	<p class="click_complete">	Mit folgendem Code können Sie ihre Teilnahme bestätigen. Bitte klicken Sie auf den folgenden Link, um Ihre Teilnahme zu dokumentieren und an den Versuchsleiter weiterzuleiten!</p>
	<!--<p class="click_complete">Bitte klicken Sie auf den folgenden Link, um Ihre Teilnahme per Mail an den Versuchsleiter zu dokumentieren und notieren Sie bitte die folgenden Zeichen!</p>-->
	<a class="complete" id="complete" href="#">{{}}</a>
	<p class="debriefing">{{}}</p>
  </div>

  <div class="progress">
    <span>Fortschritt:</span>
    <div class="bar-wrapper">
      <div class="bar" width="0%">
      </div>
    </div>
  </div>

</body>
</html>
