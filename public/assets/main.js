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
            console.log(data);
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


            // let my_events = data.my_events;
            
            // for (let i = my_events.length-1; i>=0; i--) {
            //     $('#all_events_list').prepend(`
            //         <li class="nav-item">
            //             <a href="/events/${my_events[i].id}" class="nav-link">
            //                 <p>${my_events[i].title}</p>
            //             </a>
            //         </li>
            //     `);
            // }
        },
        error: function (jqXHR, exception) {
          console.log('Ошибка интернета.')
        }
    });
}

getEventsList();

setInterval(getEventsList, 30000)