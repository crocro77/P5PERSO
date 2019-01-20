var clignotement = function () {
   if (document.getElementById('flash').style.visibility == 'visible') {
      document.getElementById('flash').style.visibility = 'hidden';
   } else {
      document.getElementById('flash').style.visibility = 'visible';
   }
};
periode = setInterval(clignotement, 800);