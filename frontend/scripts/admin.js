// const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// allSideMenu.forEach(item => {
// 	const li = item.parentElement;

// 	item.addEventListener('click', function () {
// 		allSideMenu.forEach(i => {
// 			i.parentElement.classList.remove('active');
// 		})
// 		li.classList.add('active');
// 	})
// });


// const menuBar = document.querySelector('#content nav .bx.bx-menu');
// const sidebar = document.getElementById('sidebar');

// menuBar.addEventListener('click', function () {
// 	sidebar.classList.toggle('hide');
// })



// const switchMode = document.getElementById('switch-mode');

// switchMode.addEventListener('change', function () {
// 	if (this.checked) {
// 		document.body.classList.add('dark');
// 	} else {
// 		document.body.classList.remove('dark');
// 	}
// });

// document.addEventListener('DOMContentLoaded', function () {
// 	showContent('dashboard');
// });

// function showContent(content) {
// 	var contents = document.querySelectorAll('.content');
// 	contents.forEach(function (el) {
// 		el.classList.remove('active');
// 	});

// 	document.getElementById(content + 'Content').classList.add('active');
// }


const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
let logoState = false; // false represents the initial state, assuming the first image is displayed initially

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        // Toggle between two images when a side menu item is clicked

        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        li.classList.add('active');
    });
});

const menuBar = document.querySelector('#content nav .bx.bx-menu');
const logo = document.getElementById('logo');
const sidebar = document.getElementById('sidebar');
logo.src = 'image/mainlogo3.jpg'; // Set the first image path
logo.style.width = "200px";
logo.style.height = "80px";
menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
    if (logoState) {
        logo.src = 'image/mainlogo3.jpg'; // Set the first image path
        logo.style.width = "200px";
        logo.style.height = "80px";
    } else {
        logo.src = 'image/mainlogo2.png';
        logo.style.width = "48px";
        logo.style.height = "40px";// Set the second image path
    }
    logoState = !logoState; // Toggle the state
});

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    showContent('dashboard');
});

function showContent(content) {
    var contents = document.querySelectorAll('.content');
    contents.forEach(function (el) {
        el.classList.remove('active');
    });

    document.getElementById(content + 'Content').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('announcement-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var announcementInput = document.getElementById('announcement');
        var announcement = announcementInput.value;

        showAlert('Announcement made!');
        announcementInput.value = '';
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var addNewEvent = document.getElementById('add-new-event');

    addNewEvent.addEventListener('click', function () {
        window.location.href = 'NewEvent.html';
    });

    var postEventButton = document.getElementById('post-event');

    postEventButton.addEventListener('click', function () {
        var eventName = document.getElementById('event-name').value;
        var eventType = document.getElementById('event-type').value;
        var venue = document.getElementById('venue').value;
        var city = document.getElementById('city').value;
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;
        var openForAll = document.getElementById('open-for-all').value;
        var guestPerformer = document.getElementById('guest-performer').value;
        var registrationFees = document.getElementById('registration-fees').value;
        var registrationOpenTill = document.getElementById('registration-open-till').value;

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><p>4</p></td>
            <td>${eventName}</td>
            <td>${eventType}</td>
            <td>${venue}</td>
            <td>${city}</td>
            <td>${date}</td>
            <td>${time}</td>
            <td>${openForAll}</td>
            <td>${guestPerformer}</td>
            <td>${registrationFees}</td>
            <td>${registrationOpenTill}</td>
            <td><span class="status pending">Delete</span></td>
        `;

        var tableBody = document.querySelector('.table-data tbody');
        tableBody.appendChild(newRow);

        // Redirect after appending the new event to the table
        window.location.href = 'Admin.html';
    });
});