<h1>Подробная информация об [[+name]] [[+secondname]] [[+family]]</h1>
<div class="col-xs-3">
    <section class="side-widget">
        <div class="chs-photo">
            <img src="[[+image]]" class="img-responsive">
        </div>
    </section>
</div>
<div class="col-xs-6">
    <section class="widget">
        <h2>Информация</h2>
        <p><strong>ФИО:</strong> [[+name]] [[+secondname]] [[+family]]</p>
        <p><strong>Город:</strong> [[+city_name]]</p>
        <p><strong>Место работы:</strong> [[+organization]]</p>
        <p><strong>Гос. номер автомобиля:</strong> [[+number_auto]]</p>
        <div class="chs-description">
            <strong>Описание поступка:</strong><br>[[+description]]
        </div>
    </section>
</div>
<div class="col-xs-3">
    <section class="side-widget">
        <div class="chs-cash">
            <h2>Это Вы?</h2>
            <p>
                Если Вы обнаружили, что на данной странице размещена информация о Вас, Вы можете связаться с владельцем данной информации и убрать информацию.
                <div class="chs-show-phone">
                <a href="#myModal" class="btn btn-primary" data-toggle="modal">Показать номер телефона</a>
                </div>
            </p>
        </div>
    </section>
</div>
<!-- HTML-код модального окна-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Получить номер телефона</h4>
            </div>
            <div class="modal-body">
                Для того, чтобы связаться с пользователем, разместившим информацию о Вас, Вам необходимо заполнить контактную форму и отправить запрос. Далее пользователь свяжется с Вами, если посчитает это нужным.
                [[!AjaxForm?
                    &snippet=`FormIt`
                    &form=`tpl.CHS.cashPhone`
                    &hooks=`email`
                    &emailSubject=`Запрос контактов с сайта Черный список.РФ`
                    &emailTo=`info@dokaweb.ru`
                    &validate=`name:required,email:required,message:required`
                    &validationErrorMessage=`В форме содержатся ошибки!`
                    &successMessage=`Сообщение успешно отправлено`
                    ]]
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>