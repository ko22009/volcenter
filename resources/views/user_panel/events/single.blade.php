<div id="admin-wrapper" >
	<!-- 'event_start', 'event_end', 'name', 'image', 'descr', 'address','event_type' -->

	<h2 class="h2-big">Мероприятие '{{ev.name}}'</h2>

	<div id="events-wrapepr" >
		<div class="event-watch" >
			<div><img ng-src="{{ ev.image }}"></div>
			<div class="event-watch-descr">{{ev.descr}}</div>
			<p ng-if="ev.event_start && ev.event_end"><span>Дата:</span> {{ev.event_start | date:'yyyy-MM-dd HH:mm'}} - {{ev.event_end | date:'yyyy-MM-dd HH:mm'}}
            <p><span>Место: </span>{{ev.address}}
			<p><span>Тип мероприятия: </span>{{ev.get_event_type.name}}

            <!--<p><span>Подтверждено участников: </span>{{ev.users}}
            <p><span>Ожидает подтверждения: </span>{{ev.users}}-->

            <p><span>Стимулы </span> <i ng-show="ev.get_motivation.length == 0">Не указано</i>
            <div class="lan-obj" ng-repeat="motivate in ev.get_motivation">
                <p><span>Краткое описание: </span>{{motivate.name}}
                <p><span>Полное описание: </span>{{motivate.descr}}
            </div>

            <p><span>Направления </span> <i ng-show="ev.get_responsibility.length == 0"> Не указано</i>
            <div class="lan-obj" ng-repeat="res in ev.get_responsibility">
                <p><span>Назвение позиции: </span>{{res.position}}
                <p><span>Описание задачи позиции: </span>{{res.task}}
                <p><span>Требуемое кол-во участников: </span>{{res.count}}
            </div>

		</div>

		<div ng-if="role == 'anonymous'" class="events-anon">
			<a ui-sref="login">Войдите</a> или <a ui-sref="reg">зарегистрируйтесь</a>,
			чтобы принять участие в мероприятии
		</div>

		<div ng-if="role == 'isloggedin'" class="bordered">
			<h4 class="h4-mar-lit">Принять участие в мероприятии?</h4>
			<div class="button button-color-2" id="bt-up" ng-click="go()">ОК</div>
		</div>
		
		</div>
	</div>

</div>