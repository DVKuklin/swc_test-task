$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    url: '/users/get',
    method: 'get',
    success: function (data) {
        $('#user').html(data.data.name + ' ' + data.data.surname);	
    },
    error: function (jqXHR, exception) {
      console.log('Ошибка интернета.')
    }
});

function getEventsList() {
    $.ajax({
        url: '/events',
        method: 'get',
        success: function (data) {
            let all_events = data.all_events;
            $('#all_events_list').empty();
            $('#all_events_list').append(`<li class="nav-header font-weight-bold"><h4>Все события</h4></li>`);
            for (let i = 0; i<all_events.length; i++) {
                $('#all_events_list').append(`
                    <li class="nav-item">
                        <a href="/events/${all_events[i].id}" class="nav-link">
                            <p>${all_events[i].title}</p>
                        </a>
                    </li>
                `);
            }

            let my_events = data.my_events;
            $('#my_events_list').empty();
            $('#my_events_list').append(`<li class="nav-header font-weight-bold"><h4>Мои события</h4></li>`);
            for (let i = 0; i<my_events.length; i++) {
                $('#my_events_list').append(`
                    <li class="nav-item">
                        <a href="/events/${my_events[i].id}" class="nav-link">
                            <p>${my_events[i].title}</p>
                        </a>
                    </li>
                `);
            }           
        },
        error: function (jqXHR, exception) {
          console.log('Ошибка интернета.')
        }
    });
}

getEventsList();
setInterval(getEventsList, 30000)

function takePart(event_id) {
    $.ajax({
        url: '/participants/add',
        method: 'post',
        data: {event_id: event_id},
        success: function (data) {
            if (data.success) {
                $('#buttonTekePart').addClass('d-none');
                $('#buttonRefusePart').removeClass('d-none');
                getParticipantList();
            }
        },
        error: function (jqXHR, exception) {
          console.log('Ошибка интернета.')
        }
    });
}

function refusePart(event_id) {
    $.ajax({
        url: '/participants/remove',
        method: 'post',
        data: {event_id: event_id},
        success: function (data) {
            if (data.success) {
                $('#buttonTekePart').removeClass('d-none');
                $('#buttonRefusePart').addClass('d-none');
                getParticipantList();
            }
        },
        error: function (jqXHR, exception) {
          console.log('Ошибка интернета.')
        }
    });
}

function getParticipantList() {
    $.ajax({
        url: '/participants',
        method: 'post',
        data: {event_id: document.event_id},
        success: function (data) {
            if (data.success) {
                $('#participantList').empty();
                data.participants.forEach((item) => {
                    $('#participantList').append(`<li><a href="/users/${item.id}">${item.name} ${item.surname}</a></li>`);
                })
            }
        },
        error: function (jqXHR, exception) {
          console.log('Ошибка интернета.')
        }
    });
}

if (document.event_id) {
    setInterval(getParticipantList, 30000);
}