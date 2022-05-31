"use strict";

$("#myEvent").fullCalendar({
    height: 'auto',
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    editable: true,
    events: [
        {
            title: 'Reporting',
            start: '2019-08-10T11:30:00',
            backgroundColor: "#f56954",
            borderColor: "#f56954",
            textColor: '#fff'
        },
        {
            title: 'Conference',
            start: '2019-09-9',
            end: '2019-09-11',
            backgroundColor: "#fff",
            borderColor: "#fff",
            textColor: '#000'
        },
        {
            title: "John's Birthday",
            start: '2019-09-14',
            backgroundColor: "#007bff",
            borderColor: "#007bff",
            textColor: '#fff'
        },
        {
            title: 'Reporting',
            start: '2019-09-10T11:30:00',
            backgroundColor: "#f56954",
            borderColor: "#f56954",
            textColor: '#fff'
        },
        {
            title: 'Starting New Project',
            start: '2019-09-11',
            backgroundColor: "#ffc107",
            borderColor: "#ffc107",
            textColor: '#fff'
        },
        {
            title: 'Social Distortion Concert',
            start: '2019-09-24',
            end: '2019-09-27',
            backgroundColor: "#000",
            borderColor: "#000",
            textColor: '#fff'
        },
        {
            title: 'Lunch',
            start: '2019-09-24T13:15:00',
            backgroundColor: "#fff",
            borderColor: "#fff",
            textColor: '#000',
        },
        {
            title: 'Company Trip',
            start: '2019-09-28',
            end: '2019-09-31',
            backgroundColor: "#fff",
            borderColor: "#fff",
            textColor: '#000',
        },
        {
            title: "John's Birthday",
            start: '2019-10-14',
            backgroundColor: "#007bff",
            borderColor: "#007bff",
            textColor: '#fff'
        },
        {
            title: 'Reporting',
            start: '2019-10-10T11:30:00',
            backgroundColor: "#f56954",
            borderColor: "#f56954",
            textColor: '#fff'
        },
        {
            title: 'Starting New Project',
            start: '2019-10-11',
            backgroundColor: "#ffc107",
            borderColor: "#ffc107",
            textColor: '#fff'
        },
        {
            title: 'Social Distortion Concert',
            start: '2019-10-24',
            end: '2019-10-27',
            backgroundColor: "#000",
            borderColor: "#000",
            textColor: '#fff'
        },
    ]

});
