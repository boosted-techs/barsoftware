function items(items) {
}

let itemsSelected = [];
let rowCount = 0;

function updateDom(selectedValue) {
    console.log(selectedValue);
    if(selectedValue.length < 1) {
        return;
    }
    console.log(itemsSelected);
    if(itemsSelected.includes(selectedValue)) {
        incrementQty(selectedValue);
    } else {
        itemsSelected.push(selectedValue);
        let selectedItem = itemList.find(item => item.id == selectedValue);
        console.log(selectedItem)
        if (selectedItem) {
            rowCount = +rowCount + 1;
            let element = "" +
                "<tr id='row" + selectedValue + "'>" +
                "<td>" + (rowCount) + "</td>" +
                "<td>" + selectedItem.name + "</td>" +
                "<td>" + selectedItem.price + "</td>" +
                "<td>" +
                "<input type='number' id='qty" + selectedValue + "' name='qty[]' value='1' style='width:50px'>" +
                "<input type='hidden' value='" + selectedItem.id + "' name='items[]'>" +
                "</td>" +
                "<td><span style='font-size:20px; cursor: pointer' class='text-danger' type='button' onclick='removeItem(" + selectedValue + ")'>X</span></td>" +
                "</tr>";
            $("#invoiceContent").append(element);
        }
    }

    $("#select-field").val('');
}

function incrementQty(element) {
    element = "#qty" + element;
    let value = +($(element).val()) + 1;
    $(element).val(value);
}

function removeItem(element) {
    let index = itemsSelected.indexOf(element);

    // Remove the element from the array
    itemsSelected.splice(index, 1);
    $("#row" + element).remove();
}


/*
Room list starts here
 */

let roomsSelected = [];
let rowRoomCount = 0;

function updateRoom(selectedValue) {
    console.log(selectedValue);
    if(selectedValue.length < 1) {
        return;
    }
    console.log(roomsSelected);
    if(roomsSelected.includes(selectedValue)) {

    } else {
        roomsSelected.push(selectedValue);
        let selectedItem = roomList.find(item => item.id == selectedValue);
        //console.log(selectedItem)
        if (selectedItem) {
            rowRoomCount = +rowRoomCount + 1;
            let element = "" +
                "<tr id='room" + selectedValue + "'>" +
                "<td>" + (rowRoomCount) + "</td>" +
                "<td>" + selectedItem.room_number + "</td>" +
                "<td>" + selectedItem.price + "</td>" +
                "<td>" +

                "<input type='hidden' value='" + selectedItem.id + "' name='rooms[]'>" +
                "</td>" +
                "<td><span class='text-danger' style='font-size:20px; cursor: pointer' type='button' onclick='removeRoomItem(" + selectedValue + ")'>X</span></td>" +
                "</tr>";
            $("#RoomInvoiceContent").append(element);
        }
    }

    $("#select-field2").val('');
}

function incrementRoomQty(element) {
    element = "#qty" + element;
    let value = +($(element).val()) + 1;
    $(element).val(value);
}

function removeRoomItem(element) {
    let index = roomsSelected.indexOf(element);
    // Remove the element from the array
    roomsSelected.splice(index, 1);
    $("#room" + element).remove();
}
