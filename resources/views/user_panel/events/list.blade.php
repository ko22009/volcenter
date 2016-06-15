<div id="admin-wrapper">

	<h2>Мероприятия</h2>

	<div id="events-wrapepr" >
		<h3>Мероприятия, которые скоро пройдут</h3>

		<h4 ng-show="load">Загрузка...</h4>

		<div class="main-page-event admin-page-event" ng-repeat="ev in events">
			
			<a class="page-event-a" href="#/event/{{ev.id}}">
				<img ng-src="{{ ev.image }}">
				<div class="event-name">{{ev.name}}</div>
				<div class="event-dateStart event-dark">С: {{ev.event_start}}</div>
				<div class="event-dateEnd event-dark">По: {{ev.event_end}}</div><br>
				<div class="event-type event-dark">{{ev.get_event_type.name}}</div>
				<div class="event-place">{{ev.address}}</div>

				<!--<div class="event-nums">
					<div class="event-num">Подтверждено участников: {{ev.num}}</div>
					<div class="event-numWait">Ожидает подтверждения: {{ev.numWait}}</div>
				</div>-->
			</a>
		</div>

		<h3 ng-show="eventsLast.length != 0">Прошедшие мероприятия</h3>

		<div class="main-page-event admin-page-event" ng-repeat="ev in eventsLast">

			<a  href="{{ev.id}}.html" >
				<div class="event-name">{{ev.name}}</div>

				<div class="event-dateStart event-dark">С: {{ev.dateStart}}</div>
				<div class="event-dateEnd event-dark">По: {{ev.dateEnd}}</div><br>
				<div class="event-type event-dark">{{ev.type}}</div>
				<div class="event-place">{{ev.place}}</div>
			</a>
		</div>

	</h4>
</div>