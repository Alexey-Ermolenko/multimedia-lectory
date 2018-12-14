/*  
    http://www.dailycoding.com/ 
*/
/*
(function ($) {
    $.fn.imageLens = function (options) {

        var defaults = {
            lensSize: 100,
            borderSize: 4,
            borderColor: "#888"
        };
        var options = $.extend(defaults, options);
        var lensStyle = "background-position: 0px 0px;width: " + String(options.lensSize) + "px;height: " + String(options.lensSize)
            + "px;float: left;display: none;border-radius: " + String(options.lensSize / 2 + options.borderSize)
            + "px;border: " + String(options.borderSize) + "px solid " + options.borderColor 
            + ";background-repeat: no-repeat;position: absolute;";

        return this.each(function () {
            obj = $(this);

            var offset = $(this).offset();

            // Creating lens
            var target = $("<div style='" + lensStyle + "' class='" + options.lensCss + "'>&nbsp;</div>").appendTo($(this).parent());
            var targetSize = target.size();

            // Calculating actual size of image
            var imageSrc = options.imageSrc ? options.imageSrc : $(this).attr("src");
            var imageTag = "<img style='display:none;' src='" + imageSrc + "' />";

            var widthRatio = 0;
            var heightRatio = 0;

            $(imageTag).load(function () {
                widthRatio = $(this).width() / obj.width();
                heightRatio = $(this).height() / obj.height();
            }).appendTo($(this).parent());

            target.css({ backgroundImage: "url('" + imageSrc + "')" });

            target.mousemove(setPosition);
            $(this).mousemove(setPosition);

            function setPosition(e) {

                var leftPos = parseInt(e.pageX - offset.left);
                var topPos = parseInt(e.pageY - offset.top);

                if (leftPos < 0 || topPos < 0 || leftPos > obj.width() || topPos > obj.height()) {
                    target.hide();
                }
                else {
                    target.show();

                    leftPos = String(((e.pageX - offset.left) * widthRatio - target.width() / 2) * (-1));
                    topPos = String(((e.pageY - offset.top) * heightRatio - target.height() / 2) * (-1));
                    target.css({ backgroundPosition: leftPos + 'px ' + topPos + 'px' });

                    leftPos = String(e.pageX - target.width() / 2);
                    topPos = String(e.pageY - target.height() / 2);
                    target.css({ left: leftPos + 'px', top: topPos + 'px' });
                }
            }
        });
    };
})(jQuery);
*/

(function ($) {
    $.fn.imageLens = function (options)
    {
        //Опции для лупы по умолчанию
        var defaults =
            {
                lensSize: 100,
                borderSize: 2,
                borderColor: "#000"
            };
        var options = $.extend(defaults);
        //Неизменные свойства лупы
        var lensStyle = "background-position: 0px 0px;width: " + String(options.lensSize) + "px;height: " + String(options.lensSize)
            + "px;float: left;display: none;border-radius: " + String(options.lensSize / 2 + options.borderSize)
            + "px;border: " + String(options.borderSize) + "px solid " + options.borderColor
            + ";background-repeat: no-repeat;position: absolute;";

        //
        return this.each(function () {
            obj = $(this);
            var offset = $(this).offset();

            // Создание линзы
            var target = $("<div style='" + lensStyle +"' class='" + 'loop' + "'>&nbsp;</div>").appendTo($("body"));
            // var targetSize = target.size();

            //Создание картинки в линзе
            if (canvasLoop.getContext)
            {
                var slide = document.getElementById("demo_view_block");
                var imageSrc=canvasLoop.toDataURL("image/png");
                var newLoopPicture = document.createElement('img');
                newLoopPicture.setAttribute('class', 'loopimg');
                newLoopPicture.setAttribute('src', imageSrc);
                newLoopPicture.setAttribute('style', 'display:none');
                slide.appendChild(newLoopPicture);
            }
            var widthRatio = 0;
            var heightRatio = 0;
            //Загрузка картинки и отношений размеров
            // ML_TODO:  DO WORK Ошибка в методе
            $('.loopimg').load(function ()
            {
                widthRatio = $(this).width() / obj.width();
                heightRatio = $(this).height() / obj.height();
            }).appendTo($(this).parent());
            target.css({ backgroundImage: "url('" + imageSrc + "')" });
            //При движении мыши в слайде
            target.mousemove(setPosition);
            $(this).mousemove(setPosition);
            //Определение позиций
            function setPosition(e) {

                var leftPos = parseInt(e.pageX - offset.left);
                var topPos = parseInt(e.pageY - offset.top);

                //Есди вышли за пределы слайда
                if (leftPos < 0 || topPos < 0 || leftPos > obj.width() || topPos > obj.height()) {
                    target.hide();
                    //sendHideLoop();
                }
                //В слайде
                else
                {
                    //Позиция изображения в лупе
                    var leftPos2;
                    var topPos2;
                    target.show();
                    leftPos = String(((e.pageX - offset.left) * widthRatio - target.width() / 2) * (-1));
                    topPos = String(((e.pageY - offset.top) * heightRatio - target.height() / 2) * (-1));
                    target.css({ backgroundPosition: leftPos + 'px ' + topPos + 'px' });

                    //Позиция лупы
                    leftPos2 = String(e.pageX - target.width() / 2);
                    topPos2 = String(e.pageY - target.height() / 2);
                    target.css({ left: leftPos2 + 'px', top: topPos2 + 'px' });
                    //От избыточности
                    /*
                    if (statusAction==2)
                    {
                        sendLoopAction (e.pageX - offset.left,e.pageY - offset.top);
                    }
                    */
            }
        }
    });
};
})(jQuery);
