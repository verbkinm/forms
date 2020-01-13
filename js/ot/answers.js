document.addEventListener("DOMContentLoaded", ready);

function ready() 
{
	table_row_numbers();		
	recalculation();
}
	
function add(element)
{
	let tr = element.parentNode.parentNode;
	let table = tr.parentNode;	
	table.insertBefore(tr_with_fields(), tr);	
	table_row_numbers();

	let deleting_tr = document.getElementById("no_missing");
	if(deleting_tr != null)
		deleting_tr.parentNode.removeChild(deleting_tr);
}

function remove(element)
{
	let tr = element.parentNode.parentNode;
	let table = tr.parentNode;

	table.removeChild(tr);
	table_row_numbers();
	total_change();

	if(table.querySelectorAll("tr").length == 1)
	{
		let tr = document.createElement("tr");
		tr.setAttribute("id", "no_missing");
		tr.innerHTML = "<td colspan='7'>Отсутствующих нет!</td>";
		table.insertBefore(tr, table.firstChild);
	}
}

function tr_with_fields()
{
	let number = document.querySelectorAll(".rows_with_data_fields").length;
	let tr_with_fields = document.createElement("tr");
	tr_with_fields.setAttribute("class", "rows_with_data_fields");
	tr_with_fields.innerHTML = `\
						<td>X</td>\
						<td><input name='answer${number}' required></td>\
						<td><input type='checkbox' name='is_correct${number}'></td>\
						<td class='remove_unit'><input type='button' onclick='remove(this)'></td>`;
	return tr_with_fields;
}		

function recalculation()
{
	document.querySelectorAll(".rows_with_data_fields").forEach(function(item, i, arr)
	{
		data_change(item.querySelectorAll("input[type=\"number\"]")[0]);
	});
}

function table_row_numbers()
{
	let count  = 0;
	let tables = document.getElementsByClassName("table_answer");
	for(var item = 0; item < tables.length; item++)
	{
		count  = 0;
		tables[item].querySelectorAll(".rows_with_data_fields").forEach(function(item, i, arr)
		{
			item.querySelector("td").innerHTML = 1+i;
			count = i;
		});
	}
	
	// if(count > 48)
	// {
		// document.getElementById("add_button").setAttribute("disabled","");
	// }
	// else
		// document.getElementById("add_button").removeAttribute("disabled");
}

function data_change(element)
{
	let tr = element.parentNode.parentNode;
	let first_input = tr.querySelectorAll("input[type=\"number\"]")[0];
	let second_input = tr.querySelectorAll("input[type=\"number\"]")[1];
	let third_input = tr.querySelectorAll("input[type=\"number\"]")[2];
	let fourth_input = tr.querySelectorAll("input[type=\"number\"]")[3];
	fourth_input.value = Number(first_input.value) + Number(second_input.value) + Number(third_input.value);
	
	total_change();
}

function total_change()
{
	let table = document.querySelector(".table_passes");
	let global_total = document.getElementById("total");
	global_total.value = 0;
	table.querySelectorAll("tr").forEach(function(item, i, arr)
	{
		if(i == 0 || i >= arr.length - 1)
			return;
		let total = item.querySelectorAll("input[type=\"number\"]")[3];
		if(total != null)
			global_total.value = Number(global_total.value) + Number(total.value);
	});
}