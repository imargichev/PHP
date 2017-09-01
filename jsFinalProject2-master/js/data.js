/* Data Js */

var activate = ()=>{
	var data = document.getElementById("data"), results = data.getElementsByClassName("results")[0];

	var popUp = document.getElementById("popUp"), dayName = popUp.querySelector("p:nth-of-type(1)"), workDone = popUp.querySelector("p:nth-of-type(2)"), tasksCompleted = popUp.querySelector("p:nth-of-type(3)");

	var resultsChildren = results.querySelectorAll(".result");

	console.log(resultsChildren);

	for(child of resultsChildren){
		console.log(child);
		
		child.addEventListener("mouseover", e =>{
			showPopUp(e.target);
		});
		
		child.addEventListener("mouseout", ()=>{
			hidePopUp();
		});
	}

	function showPopUp(elem){
		let data = elem.getAttribute("data-result");
		let parsed = JSON.parse(data);
		
		dayName.textContent = parsed.dayName;
		workDone.textContent = "Работа свършена в проченти: " + parsed.workDone + "%";
		tasksCompleted.textContent = "Решени за деня задачи: " + parsed.tasksCompleted;
		
		popUp.style.opacity = 1;
		
		for(child of resultsChildren){
			child.classList.add("faded");
		}
		
		elem.classList.remove("faded");
	}

	function hidePopUp(){
		for(child of resultsChildren){
			child.classList.remove("faded");
		}
		
		popUp.style.opacity = 0;
	}
}

/********************/
/* Create Datagram */
/******************/

//var args = {numOfDays: 3, workDone: [{workDone: 5, tasksCompleted: 5}, {workDone: 5, tasksCompleted: 5}, {workDone: 5, tasksCompleted: 5}]};


function createDatagram(daysArr){
	let sum = 0;
	let max = daysArr[0];
	
	for(let i = 0; i < daysArr.length; i++){
		if(max < daysArr[i]){
			max = daysArr[i];
		}
		
		sum += daysArr[i];
	}
	
	//The wrapper
	let wrapper = $("<div>");
	
	wrapper.attr({"class": "datagram", id: "data"});
	
	//Options Part
	let options = $("<div>");
	
	options.attr("class", "options");
	
	for(let i = 0; i < daysArr.length; i++){
		let p = $("<p>");
		
		p.text("Ден " + (i + 1));
		
		options.append(p);
	}
	
	wrapper.append(options);
	
	//Results Part
	let results = $("<div>");
	
	results.attr("class", "results");
	
	for(let i = 0; i < daysArr.length; i++){
		let div = $("<div>");
		
		let resultWidth = (daysArr[i]/max)*100;
		
		//Some parts from the info object
		let workDone = ((daysArr[i]/sum)*100).toFixed(1);
		
		let obj = {"workDone": workDone , "tasksCompleted": daysArr[i], "dayName": "Ден " + (i + 1)};
		
		let stringified = JSON.stringify(obj);
		
		div.attr({"class": "result", style: "width: " + resultWidth + "%", "data-result": stringified});
		
		results.append(div);
	}
	
	let popUp = $("<div>");
	
	popUp.attr({"class": "showData", id: "popUp"});
	
	for(let i = 0; i <= 3; i++){
		let span = $("<p>");
		
		popUp.append(span);
	}
	
	results.append(popUp);
	
	wrapper.append(results);
	
	//Parts part
	let parts = $("<div>");
	
	parts.attr("class", "parts");
	
	let partWidth = 100/(max + 1);
	
	for(let i = 0; i <= max; i++){
		let part = $("<span>");
		
		part.css("width", partWidth + "%");
		
		part.text(i);
		
		parts.append(part);
	}
	
	wrapper.append(parts);
	
	$("#mainDatagram").append(wrapper);
	
	activate();
	
	return true;
}

/**********************/
/* Answer a question */
/********************/

function createAnswer(daysArr, questsArr){
	let sum = 0;
	
	for(let i = 0; i < daysArr.length; i++){
		sum += daysArr[i];
	}
	
	for(let i = 0; i < questsArr.length; i++){
		let f = questsArr[i][0]; //From
		let t = questsArr[i][1]; //To
		
		let wrapper = $("<div>");
		
		let innerWrapper = $("<div>");
		
		wrapper.attr("class", "datagram2");
		
		innerWrapper.attr("class", "datagram-wrapper");
		
		wrapper.append(innerWrapper);
		//Multiple used
		let toDay = $("<p>");
		let fromDay = $("<p>");
		
		toDay.text("Ден");
		fromDay.text("Ден");
		
		//Making the day boxes
		
		let fromBox = $("<div>");
		
		fromBox.attr("class", "box-1");
		
		let fromDayH = $("<p>");
		
		fromDayH.text(f);
		
		fromBox.append(fromDayH);
		fromBox.append(fromDay);
		
		let toBox = $("<div>");
		
		toBox.attr("class", "box-1");
		
		let toDayH = $("<p>");
		
		toDayH.text(t);
		
		toBox.append(toDayH);
		toBox.append(toDay);
		
		//Making the thumb
		let periodSum = 0;
		
		for(let i = f - 1; i <= t - 1; i++){
			periodSum += daysArr[i];
		}
		
		let pieceWidth = (periodSum/sum)*100;
		
		console.log(pieceWidth);
		
		let track = $("<div>");
		let piece = $("<div>");
		
		track.attr("class", "track-2");
		
		piece.attr("class", "piece-2");
		
		piece.css("width", pieceWidth + "%");
		
		track.append(piece);
		
		//Creating the stats box
		
		let box = $("<div>");
		
		let percents = $("<p>");
		let tasks = $("<p>");
		
		percents.text("Работа свършена в проценти: " + pieceWidth.toFixed(1) + "%");
		tasks.text("Брой решени задачи за периода: " + periodSum);
		
		box.append(percents);
		box.append(tasks);
		
		box.attr("class", "stats");
		
		innerWrapper.append(fromBox);
		innerWrapper.append(track);
		innerWrapper.append(toBox);
		innerWrapper.append(box);
		
		$("#questsDatagram").append(wrapper);
	}
	
	return true;
}