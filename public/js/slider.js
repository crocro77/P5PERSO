"use strict";

$(document).ready(function () {
  init();

  function init() {
    var sliderInterval;

    // objet slider
    let slider = {
      index: 0,
      images: ['public/img/GG.jpg', 'public/img/GG2.jpg', 'public/img/GG3.jpg'],
      next: () => {
        if (slider.index + 1 < slider.images.length) {
          slider.index += 1;
        } else {
          slider.index = 0;
        }
        $("#sliderImage").attr("src", slider.images[slider.index]);
      },

      previous: () => {
        if (slider.index - 1 >= 0) {
          slider.index -= 1;
        } else {
          slider.index = slider.images.length - 1;
        }
        $("#sliderImage").attr("src", slider.images[slider.index]);
      },

      setSliderInterval: function () {
        return setInterval(function () {
          slider.next();
        }, 5000);
      }
    };

    function attachSliderEvents() {
      $("#previous").click(slider.previous);
      $("#next").click(slider.next);
      $("#sliderImage").on("mouseover", function () {
        clearInterval(sliderInterval);
      });

      $("#sliderImage").on("mouseleave", function () {
        sliderInterval = slider.setSliderInterval();
      });

      $(document).keydown(function (e) {
        if (e.keyCode === 37) {
          slider.previous();
        }
        else if (e.keyCode === 39) {
          slider.next();
        }
      });
    }

    sliderInterval = slider.setSliderInterval();
    attachSliderEvents();
  }
})