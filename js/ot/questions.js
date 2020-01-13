document.addEventListener("DOMContentLoaded", ready_question);

function ready_question() 
{
	questions_numbers();		
}

function questions_numbers()
{
	let count  = 0;
	let nodeList = document.querySelectorAll(".question_number");
	for(var item = 0; item < nodeList.length; item++)
	{
		nodeList[item].innerHTML = "<h3>Вопрос №" + (1+item) + "</h3>";
		count = i;
	}
}

function add_question(element)
{
	let tr = element.parentNode.parentNode;
	let table = tr.parentNode;	
	table.insertBefore(tr_with_fields(), tr);	
	questions_numbers();

	let deleting_tr = document.getElementById("no_missing");
	if(deleting_tr != null)
		deleting_tr.parentNode.removeChild(deleting_tr);
}
