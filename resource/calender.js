class Calender {
    container_name = "";
    popupName = "";
    date = new Date();
    current_month = this.date.getMonth() + 1;
    current_year = this.date.getFullYear();
    month_name = ["January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];
    event = [


    ]

    leaveevent = [

    ]

    constructor(contaienrName, popupName) {
        this.container = document.getElementById(contaienrName);
        this.container_name = contaienrName;
        this.popupName = document.getElementById(popupName);
        this.init();

    }

    init() {
        this.container.innerHTML = '';
        let calender = document.createElement('div');
        calender.classList.add('calender');
        calender.appendChild(this.createMothYear());
        calender.appendChild(this.createDaysContainer());
        this.container.appendChild(calender);
        this.addCalenderEvents();
        this.addCalenderLeavedays();
    }

    getDateCount(year, month) {
        return 32 - new Date(year, month - 1, 32).getDate();
    }

    getStartDate(year, month) {
        return (new Date(year, month - 1)).getDay();
    }

    createMothYear() {
        // create month year container
        let month_year_container = document.createElement('div');
        month_year_container.classList.add("month-year-container");
        // create left arrow button

        // let arrow_left = document.createElement('i');
        // arrow_left.setAttribute("data-feather" ,"arrow-left-circle" );
        let arrow_left = document.createElement('i');
        // arrow_right.setAttribute("data-feather" ,"arrow-right-circle" );
        arrow_left.classList.add("pre-nxt-month-btn");
        arrow_left.setAttribute('onclick', this.container_name + '.previousMonth()');
        arrow_left.innerText = '<';
        // create month year title
        let month_year_title = document.createElement('span');
        month_year_title.innerText = this.month_name[this.current_month - 1] + " " + this.current_year;
        // create right arrow button
        let arrow_right = document.createElement('i');
        // arrow_right.setAttribute("data-feather" ,"arrow-right-circle" );
        arrow_right.classList.add("pre-nxt-month-btn");
        arrow_right.innerText = '>';
        arrow_right.setAttribute("onclick", this.container_name + ".nextMonth()")
        // append to month year contaienr
        month_year_container.appendChild(arrow_left);
        month_year_container.appendChild(month_year_title);
        month_year_container.appendChild(arrow_right);

        // return moth year container
        return month_year_container;

    }

    createDaysContainer() {

        // create days container
        let days_container = document.createElement('div');
        days_container.classList.add("days-container"); // add class
        // create day names set
        let days_names = document.createElement("div");
        days_names.classList.add("days-name");

        let dayName = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
        dayName.map(m => {
            // create day name
            let name = document.createElement("div");
            name.innerText = m;
            name.classList.add("d-name");
            // append to days name contaienr
            days_names.appendChild(name);
        });

        // append days name to day container
        days_container.appendChild(days_names);
        days_container.appendChild(this.createDays());
        // return days name container
        return days_container;
    }

    createDays() {
        // carete div for days contaienr
        let days = document.createElement('div');
        days.classList.add('days');
        let startDate = this.getStartDate(this.current_year, this.current_month) - 1;
        let lastMonthLastDate = this.getDateCount(this.current_year, this.current_month - 1);
        let currentDate = 1;
        let nextMonthDate = 1;
        let temp = startDate - 1;
        for (let i = 1; i <= 42; i++) {
            // crete div for date
            let day = document.createElement('div');
            day.classList.add("date");
            if (i <= startDate) {
                // set day number
                day.innerText = lastMonthLastDate - temp;
                temp--;
                // add dynamic id
                // day.id = "date"+i;
            } else if (i > startDate && currentDate <= this.getDateCount(this.current_year, this.current_month)) {
                // set day number
                day.innerText = currentDate;
                // add dynamic id
                day.id = "date" + currentDate;

                // check date to today
                if (currentDate == this.date.getDate() && this.current_month == this.date.getMonth() + 1) {
                    day.classList.add("today");
                } else {
                    day.classList.add("currentMonthday");
                }
                currentDate++;

            } else {
                // set day number
                day.innerText = nextMonthDate;
                nextMonthDate++;
                // add dynamic id
                // day.id = "date"+i;
            }


            // append date to day conatiner
            days.appendChild(day);

        }

        // return days
        return days;
    }

    addCalenderEvents() {
        this.event.map(eventItem => {
            console.log(this.current_month);
            if (this.current_month == eventItem.month && this.current_year == eventItem.year) {
                let day = document.getElementById("date" + eventItem.date);
                // console.log(JSON.stringify([eventItem]))
                day.setAttribute("onclick", this.container_name + '.showCalenderEnvetPopup(' + JSON.stringify([eventItem]) + ')');
                // day.setAttribute("onclick", "asdasd('" + eventItem  + "')");
                let badge = document.createElement('div');
                badge.classList.add('badge');
                badge.innerText = eventItem.events.length;
                day.appendChild(badge);
            }
        })
    }

    addCalenderLeavedays() {

        this.leaveevent.map(eventItem => {

            //leave days in same month
            
            if (this.current_month == eventItem.smonth && this.current_year == eventItem.syear
                && this.current_month == eventItem.emonth && this.current_year == eventItem.eyear) {
                    
                var count = (Number(eventItem.edate) - Number(eventItem.sdate));

                var i = 0;
                while (i <= count) {

                    let day = document.getElementById("date" + (Number(eventItem.sdate) + i));
                    let badge = document.createElement('div');
                    badge.classList.add("leavedays");
                    day.appendChild(badge);
                    i = Number(i) + 1;
                }

            } 

            //leave days with next month
            
            else if((this.current_month == eventItem.smonth && this.current_year == eventItem.syear)
                || (this.current_month == eventItem.emonth && this.current_year == eventItem.eyear)) {

                    
                if (this.current_month == eventItem.smonth && this.current_year == eventItem.syear){
                    var daysInMonth = new Date(eventItem.syear, eventItem.smonth, 0).getDate();
                    
                    count = Number(daysInMonth) - Number(eventItem.sdate);
                    var i = 0;
                    while (i <= count) {
    
                        let day = document.getElementById("date" + (Number(eventItem.sdate) + i));
                        let badge = document.createElement('div');
                        badge.classList.add("leavedays");
                        day.appendChild(badge);
                        i = Number(i) + 1;
                    }
                }
                
                else if(this.current_month == eventItem.emonth && this.current_year == eventItem.eyear){
                    
                    count = Number(eventItem.edate);
                    
                    var i = -1;
                    while (i < count-1) {
                        
                        let day = document.getElementById("date" + (Number(eventItem.edate) + Number(i)));
                        let badge = document.createElement('div');
                        badge.classList.add("leavedays");
                        day.appendChild(badge);
                        i = Number(i) + 1;
                    }
                }

            }
        })
    }

    nextMonth() {
        if (this.current_month > 11) {
            this.current_year++;
            this.current_month = 1
        } else {
            this.current_month++;
        }
        
        this.init();
    }

    previousMonth() {
        if (this.current_month < 2) {
            this.current_year--;
            this.current_month = 12
        } else {
            this.current_month--;
        }
        this.init();
    }

    showCalenderEnvetPopup(event) {

        let eventsContaier = document.createElement('div');
        eventsContaier.classList.add("data");

        let btn = document.getElementById("btn");

        event[0].events.map(eventitem => {
            let eventDiv = document.createElement('div');
            eventDiv.innerHTML = "Event Title :  " + eventitem.title + "<br>";
            eventDiv.innerHTML += "Event Desc :  " + eventitem.desc + "<br> <br>";
            eventsContaier.appendChild(eventDiv);
        });

        this.popupName.replaceChildren(eventsContaier);
        this.popupName.appendChild(btn);
        this.popupName.appendChild(eventsContaier);

        document.getElementById("eventpopup").style.display = "block";

    }

    addallEvents(year, month, date, taskname, status) {

        var check = false;

        this.event.map(eventItem => {

            if (date == eventItem.date && month == eventItem.month && year == eventItem.year) {
                var obje = {
                    title: taskname,
                    desc: status,
                }
                eventItem.events.push(obje);
                check = true;
            }
        })

        if (!check) {
            var obj = {
                year: year,
                month: month,
                date: date,
                events: [
                    {
                        title: taskname,
                        desc: status,
                    }
                ]
            }
            this.event.push(obj);
        }

    }

    addleaverange(syear, smonth, sdate, eyear, emonth, edate) {

        /* let day = document.getElementById("date" + 22);
         let badge = document.createElement('div');
         badge.classList.add("leavedays");
         day.appendChild(badge);*/

        var obj = {
            syear: syear,
            smonth: smonth,
            sdate: sdate,
            eyear: eyear,
            emonth: emonth,
            edate: edate,

        }

        this.leaveevent.push(obj);
    }
}

