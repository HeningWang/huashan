<html>
<meta charset="utf-8"/>
<head>
    <title>Huashan</title>

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
	<script type="text/javascript">
      var list = <?php if(isset($_GET["l"])) {
				$l = htmlspecialchars($_GET["l"]);
				} else {
				$l = 0;
				}
				echo $l;
			 ?>;
    </script>
	<!--<script type="text/javascript">
		var list = 1;
	</script>-->	

    <!-- experiment file -->
    <script src="js/experiment.js"></script>

</head>
<body onload="init();">
  <noscript>This task requires JavaScript.</noscript>

  <div class="slide" style="height:600" id="i0" >
<p id="cocolab">Teilnahmeinformationen zur Studie Huashan</p>
    <p id="instruct-text">Herzlich Willkommen bei unserer Studie zur Satzverarbeitung! Wir danken Ihnen für Ihr Interesse an dieser Studie. Wir untersuchen mit dieser Studie, wie verschiedene Sätze verstanden werden. Genauere Informationen zum Forschungszweck werden nach ihrer Teilnahme bereitgestellt. Dieses Schreiben dient dazu, Sie über das Ziel der Studie sowie über das Vorgehen in dem Forschungsprojekt zu informieren. Bitte lesen Sie sich den Text aufmerksam durch. </p>
	<p id="legal"><b>Ablauf der Studie</b>: In diesem Experiment geht es darum, zwischen mehr oder weniger passenden Beschreibungen von abgebildeten Objekten abzuwägen. Das genaue Vorgehen wird Ihnen zu Beginn anhand einiger Übungsbeispiele verdeutlicht. Es wird insgesamt 180 Durchgänge geben, die in vier Blöcke aufgeteilt sind. Zwischen den Blöcken können Sie pausieren. Das Ausfüllen des Fragebogens wird ca. 35 Minuten in Anspruch nehmen.</p>
	<p id="legal"><b>Datenverarbeitung</b>: Im Rahmen der Studie werden, abgesehen von freiwilligen Angaben am Ende, keine personenbezogenen Daten erhoben oder verarbeitet. Die anonymen Daten (Antworten im Experiment und Angaben zur Muttersprache) sowie eventuell einige freiwillige Angaben (z.B. Alter oder Kommentare zum Verlauf des Experiments) werden auf einem Server der Universität Tübingen abgespeichert. IP-Adressen, MAC-Adressen oder Ortungs-Daten sind im Rahmen der Studien nicht relevant und werden demnach nicht erhoben. Nach Beenden des Experiments wird ihr Datensatz anonym gespeichert und kann dann nicht mehr zugeordnet oder gezielt gelöscht werden. Die Projektmitarbeiter unterliegen der Schweigepflicht bzw. dem Datengeheimnis. Die anonymen Daten werden mindestens 10 Jahre gespeichert und können für zukünftige Forschungsvorhaben genutzt und weiterverarbeitet werden. Die Forschungsergebnisse aus der Studie werden in anonymer Form in Fachzeitschriften oder in wissenschaftlichen Datenbanken veröffentlicht. Bei der Veröffentlichung der Forschungsergebnisse wird Ihre Identität nicht bekannt. Der Studienleiter (Fabian Schlotterbeck) ist für die Datenverarbeitung und die Einhaltung der gesetzlichen Datenschutzbestimmungen verantwortlich und bei Fragen unter der Email-Adresse fabian.schlotterbeck@uni-tuebingen.de zu erreichen. Bei weiteren Anliegen können Sie sich an den Datenschutzbeauftragten der Universität Tübingen (Geschwister-Scholl-Platz, 72074 Tübingen, E-Mail: datenschutz@uni-tuebingen.de, Telefon: +49 70 71 29-0) wenden. Für die Erhebung, Speicherung, Nutzung und Weitergabe Ihrer Daten ist Ihre ausdrückliche Zustimmung durch Anklicken der Punkte in der Einwilligungserklärung zum Datenschutz erforderlich.   </p>
	<p id="legal"><b>Freiwilligkeit</b>: Sie können das Experiment, bis Sie den letzten Button, „Experiment beenden“, betätigen, jederzeit und ohne Angabe von Gründen abbrechen, ohne dass Ihnen daraus Nachteile entstehen. Ihre Daten werden dann nicht gespeichert. Sie haben dann trotzdem für die bis dahin vergangene Zeit Anspruch auf eine entsprechende Kompensation. Falls Sie frühzeitig abbrechen sollten, haben Sie folglich die Möglichkeit, uns zu kontaktieren, um (i) eine teilweise Entschädigung zu bekommen und (ii) ein Debriefing mit einer Erklärung unserer Forschungsfragen und Methoden zu erhalten. In diesem Fall kontaktieren Sie bitte den Studienleiter (Fabian Schlotterbeck, Email-Adresse:  fabian.schlotterbeck@uni-tuebingen.de).</p>
	<!--is the following needed-->
	<!--<p id="instruct-text">Mit dem Drücken der folgenden Taste versichern Sie, dass Sie die oben beschriebenen Teilnehmerinformationen verstanden haben und mit den genannten Teilnahmebedingungen einverstanden sind.</p>-->
	<button id="start_button">Weiter</button>
  </div>
  
  <div class="slide"  id="consent" style="padding-top:90px">
    <div class="long_form">
      <div class="consent_title"><h3>Einwilligungserklärung zur Studie Huashan</h3></div>
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
			<td>Versuchsleiter: Hening Wang</td>
			<td>Projektleiter: Fabian Schlotterbeck</td>
		  </tr>
		  <tr>
			<td><i>Universität Tübingen</i></td>
			<td><i>Universität Tübingen</i></td>
		  </tr>
		  <tr>
			<td><i>Philosophische Fakultät, Deutsches Seminar, Linguistische Abteilung</i></td>
			<td><i>Philosophische Fakultät, Englisches Seminar, Linguistische Abteilung</i></td>
		  </tr>
		  <tr>
			<td><i>Wilhelmstraße 50, Raum 448 </i></td>
			<td><i>Wilhelmstraße 50, Raum 448 </i></td>
		  </tr>
		  <tr>
			<td><code>hening.wang@student.uni-tuebingen.de</code></td>
			<td><code>fabian.schlotterbeck@uni-tuebingen.de</code></td>
		  </tr>
		  <tr>
			<td><code>07071 29 76740 </code></td>
			<td><code>07071 29 76740</code></td>
		  </tr>
		</table> 
	</p>
	<p><b>Drücken Sie jetzt die LEERTASTE</b>, um zu den Instruktionen zu gelangen.</p>
  </div>

  <div class="slide" id="instructions0" style="padding-top:60px">
    <h3>Instruktion</h3>
	<p>In diesem Experiment geht es darum, zwischen mehr oder weniger passenden Beschreibungen von abgebildeten Objekten abzuwägen.</p>
	<p>Konkret geht es um das folgende Szenario: Sie öffnen mehrere Sets bestimmter Sammelaufkleber, und tauschen sich mit einer befreundeten Person am Telefon darüber aus. Die Aufkleber sehen unscheinbar aus, sind aber in bestimmten Kreisen extrem angesagt. Jedes Set enthält sechs Aufkleber. In Jedem Durchgang des folgenden Experiments werden Sie Ihren/Ihre Gesprächspartner/in fragen, ob er/sie einen bestimmten Aufkleber aus dem jeweiligen Set für seine/ihre eigene Sammlung braucht.</p>
	<p>Der Aufkleber, um den es jeweils geht, ist auf dem Bildschirm durch einen farbigen Rahmen hervorgehoben. Ihr/e Gesprächspartner/in hat einen Katalog mit allen Aufklebersets vor sich. Er/sie kann somit zwar dieselben Aufkleber aus dem jeweiligen Set sehen. Aber weder sieht er/sie die farbige Markierung, noch ist ihm/ihr die räumliche Anordnung Ihrer Aufkleber bekannt. Um sich auf einen bestimmten Aufkleber zu beziehen müssen Sie also dessen Aussehen beschreiben.</p>
	<p>Ihre Aufgabe im Experiment wird sein, anhand eines Schiebereglers anzuzeigen, welche der beiden Ihnen gezeigten Äußerungen Sie bevorzugen, um Ihr/e Gesprächspartner/in nach dem gewünschten Aufkleber zu fragen. Falls beide Fragen möglich sind, und die Entscheidung nicht ganz klar ist, geben Sie bitte Ihre Tendenz an. Falls Sie meinen, dass keine der beiden Fragen passt, können Sie dies durch die Option „keine Beschreibung passt“ ebenfalls anzeigen.</p>
    <p><b>Drücken Sie jetzt die LEERTASTE</b>, um weiter zu kommen.</p>
  </div>
  
  <div class="slide" id="instructions" style="padding-top:60px">
	<p>Gleich geht's los.</p>
    <p>Denken Sie daran: Es geht darum, zu bewerten welche Frage passender ist, um den hervorgehobenen Aufkleber im jeweiligen Aufkleberset zu beschreiben.</p>
	<p>Nachdem Sie ihre Bewertung mit Hilfe des Schiebreglers angegeben haben, kommen Sie per Druck der <b>Leertaste</b> zum nächsten Durchgang.</p>
	<p><b>Drücken Sie jetzt die LEERTASTE</b>, um einen kurzen Übungsblock zu beginnen.</p>
  </div>

  <div class="slide" id="training">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<br>
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
	<br>
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
	<p>Denken Sie daran: Es geht darum zu bewerten, welche Aussage passender ist, um den hervorgehobenen Aufkleber im jeweiligen Aufkleberset zu beschreiben.</p>
  </div>
  
  <div class="slide" id="single_trial_second_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<br>
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
	<p>Denken Sie daran: Es geht darum, zu bewerten welche Frage passender ist, um den hervorgehobenen Aufkleber im jeweiligen Aufkleberset zu beschreiben.</p>
  </div>
  
  <div class="slide" id="single_trial_third_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<br>
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
	<p>Denken Sie daran: Es geht darum, zu bewerten welche Frage passender ist, um den hervorgehobenen Aufkleber im jeweiligen Aufkleberset zu beschreiben.</p>

  </div>

  
  <div class="slide" id="single_trial_fourth_block">
    <div class="image_display">{{}}</div>
	<p class="display_condition">{{}}</p>
    <div class="responses">
	    <span class="left_response">{{}}</span>
	    <span class="right_response">{{}}</span>
    </div>
	<br>
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
