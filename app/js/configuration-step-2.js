var target_url = document.getElementById("target_url").value;

function save_room(id, floor, number, type, cell) {

var room_id = document.getElementById(id).value;
var room_floor = document.getElementById(floor).value;
var room_number = document.getElementById(number).value;
var room_type = document.getElementById(type).value;
var current_cell = document.getElementById(cell);
var next_cell = current_cell.nextSibling;
var action = '2';
    
xhr = new XMLHttpRequest();

xhr.open('POST', target_url, true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onload = function() {
    if (xhr.readyState != 4 && xhr.status != 200) {
        alert('We are sorry! It seems something went wrong.');
    }else if (xhr.status != 200) {
        alert('Error! Request failed.  Returned status of ' + xhr.status);
    }else if(xhr.readyState == 4 && xhr.status == 200){
        next_cell.innerHTML = "OK";
        alert("Room Details Updated Succesfully");
    }
};
xhr.send("room_id="+room_id+"&room_floor="+room_floor+"&room_number="+room_number+"&room_type="+room_type+"&action="+action+"&submit=submit");
}