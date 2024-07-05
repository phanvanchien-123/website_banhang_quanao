$(function () {
  var $range = $(".js-range-slider"),
      $inputFrom = $(".js-input-from"),
      $inputTo = $(".js-input-to"),
      instance,
      min = 0,
      max = 5000000,  // Tăng giá trị tối đa lên 500,000 VND
      from = localStorage.getItem('price_min') || 0,
      to = localStorage.getItem('price_max') || 500000;

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
    prefix: "",  // Không cần prefix, chỉ hiển thị số
    step: 5000,  // Đặt bước nhảy là 5,000 VND
    prettify: function (num) {  // Định dạng giá trị để hiển thị
      return (num ).toLocaleString('vi-VN') + " VND";
    },
    onStart: updateInputs,
    onChange: updateInputs,
    onFinish: updateURLParams,  // Save search values when finished changing
    values_separator: " - ",
    force_edges: true,
  });

  instance = $range.data("ionRangeSlider");

  function updateInputs(data) {
    from = data.from;
    to = data.to;

    // Convert from/to to display format
    $inputFrom.prop("value", formatCurrency(from));
    $inputTo.prop("value", formatCurrency(to));   

    $("#prange").val(from + "," + to); 
    $("#prange").trigger('change');   
    
    localStorage.setItem('price_min', from);
    localStorage.setItem('price_max', to);
  }

  $inputFrom.on("input", function () {
    var val = parseCurrency($(this).val());
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
    var val = parseCurrency($(this).val());
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
    location.reload();  // Reload the page
  });

  function updateURLParams() {
    var url = window.location.href.split('?')[0];
    var params = new URLSearchParams(window.location.search);
    params.set('price_min', from / 1000);  // Chia cho 1000 để lấy giá trị cũ
    params.set('price_max', to / 1000);    // Chia cho 1000 để lấy giá trị cũ
    window.history.replaceState({}, '', url + '?' + params.toString());
  }

  function formatCurrency(num) {
    return (num / 1000).toLocaleString('vi-VN') + " VND";
  }

  function parseCurrency(str) {
    return parseInt(str.replace(/\D/g, ''));  // Xóa ký tự không phải số và chuyển đổi thành số
  }

  // Restore search values from URL parameters on page load
  window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    var urlMin = urlParams.get('price_min');
    var urlMax = urlParams.get('price_max');
    if (urlMin !== null && urlMax !== null) {
      instance.update({
        from: urlMin * 1000,  // Nhân với 1000 để đưa về giá trị gốc
        to: urlMax * 1000   // Nhân với 1000 để đưa về giá trị gốc
      });
    }
  };
});
