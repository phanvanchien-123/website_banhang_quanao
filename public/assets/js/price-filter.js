$(function () {
  var $range = $(".js-range-slider"),
    $inputFrom = $(".js-input-from"),
    $inputTo = $(".js-input-to"),
    instance,
    min = 0,
    max = 500,
    from = localStorage.getItem('price_min') || 0,
    to = localStorage.getItem('price_max') || 500;

  // Check if the URL contains search parameters
  var urlParams = new URLSearchParams(window.location.search);
  if (!urlParams.has('price_min') || !urlParams.has('price_max')) {
    // If search parameters are not present, set default values
    from = min;
    to = max;
  }

  $range.ionRangeSlider({
    type: "double",
    min: min,
    max: max,
    from: from,
    to: to,
    prefix: "$ ",
    onStart: updateInputs,
    onChange: updateInputs,
    onFinish: updateURLParams, // Save search values when finished changing
    step: 5,
    prettify_enabled: true,
    prettify_separator: ".",
    values_separator: " - ",
    force_edges: true,
  });

  instance = $range.data("ionRangeSlider");

  function updateInputs(data) {
    from = "$" + data.from;
    to = "$" + data.to;

    $inputFrom.prop("value", from);
    $inputTo.prop("value", to);   
    
    $("#prange").val(data.from + "," + data.to); 
    $("#prange").trigger('change');   
    
    localStorage.setItem('price_min', data.from);
    localStorage.setItem('price_max', data.to);
  }

  $inputFrom.on("input", function () {
    var val = $(this).prop("value");
    if (val < min) {
      val = min;
    } else if (val > to) {
      val = to;
    }
    instance.update({
      from: val,
    });
  });

  $inputTo.on("input", function () {
    var val = $(this).prop("value");
    if (val < from) {
      val = from;
    } else if (val > max) {
      val = max;
    }
    instance.update({
      to: val,
    });
  });

  $('#updateURLButton').on('click', function() {
    updateURLParams();
    location.reload(); // Reload the page
  });

  function updateURLParams() {
    var url = window.location.href.split('?')[0];
    var params = new URLSearchParams(window.location.search);
    params.set('price_min', from.replace('$', ''));
    params.set('price_max', to.replace('$', ''));
    window.history.replaceState({}, '', url + '?' + params.toString());
  }

  // Restore search values from URL parameters on page load
  window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    var urlMin = urlParams.get('price_min');
    var urlMax = urlParams.get('price_max');
    if (urlMin !== null && urlMax !== null) {
      instance.update({
        from: urlMin,
        to: urlMax
      });
    }
  };
});
