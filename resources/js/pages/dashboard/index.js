import { Calendar } from '@fullcalendar/core';
import { getRelativePosition } from 'chart.js/helpers';
import Chart from 'chart.js/auto';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function () {
    const calendarElement = document.getElementById('transactionCalendar');
    const requestsChartCtx = document.getElementById('requestsChart')?.getContext('2d');

    if (calendarElement) {
        const calendar = new Calendar(calendarElement, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            nowIndicator: true,
            now: new Date(),
            weekNumbers: true,
            weekText: `${langs?.['globals.week'] || 'Week'} `,
            locale: locale || 'en',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay', // Tambahkan tombol untuk mengganti tampilan
            },
            buttonText: {
                today: langs?.['globals.today'] || 'Today',
                month: langs?.['globals.monthly'] || 'Monthly',
                week: langs?.['globals.weekly'] || 'Weekly',
                day: langs?.['globals.daily'] || 'Daily',
            },
            eventTimeFormat: {
                hour12: false,
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
            },
            slotLabelFormat: {
                hour12: false,
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
            },
            events: '/dashboard/api/transactions', // Endpoint for fetching events
        });
        calendar.render();
    }

    if(requestsChartCtx) {
        const requestsChart = new Chart(requestsChartCtx, {
            type: 'line',
            data: {
                labels: charts?.completedRequests?.labels,
                datasets: [
                    {
                        label: langs?.['globals.all'],
                        borderDash: [8, 12],
                        data: charts?.allRequests?.data,
                        fill: false,
                        borderColor: 'rgb(203, 213, 225)',
                        tension: 0.3,
                        backgroundColor: 'rgb(203, 213, 225, 0.1)',
                    },
                    {
                        label: langs?.['pages.requests.status.completed'],
                        data: charts?.completedRequests?.data,
                        fill: true,
                        borderColor: 'rgb(37, 100, 235)',
                        tension: 0.3,
                        backgroundColor: 'rgb(37, 100, 235, 0.1)',
                    },
                    {
                        label: langs?.['pages.requests.status.rejected'],
                        data: charts?.rejectedRequests?.data,
                        fill: true,
                        borderColor: 'rgb(220, 38, 38)',
                        tension: 0.3,
                        backgroundColor: 'rgb(220, 38, 38, 0.1)',
                    },

                ],
            },
            options: {
              onClick: (e) => {
                const canvasPosition = getRelativePosition(e, requestsChart);

                // Substitute the appropriate scale IDs
                const dataX = requestsChart.scales.x.getValueForPixel(canvasPosition.x);
                const dataY = requestsChart.scales.y.getValueForPixel(canvasPosition.y);
              }
            }
        });
    }
});
