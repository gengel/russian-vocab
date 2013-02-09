var tiers = [];
var all_items = [];
var results = [];
var set = 0;
var index = 0;

function start() {
  results.push(0);
  next();
}

function yes() {
  results[set]++;
  next();
}

function no() {
  next();
}

function next() {
  if (set < all_items.length && index < all_items[set].length) {
    $("h1").html(all_items[set][index]);
    index++;
  } else if (set < all_items.length) {
    index = 0;
    set++;
    results.push(0);
    next();
  } else {
    end();
  }
}

function end() {
  var total = 0;
  var last_tier = 0;
  $.each(tiers, function(i, tier) {
    tier = parseInt(tier);
    var max = all_items[i].length;
    var percent = results[i] / max;
    var words = Math.round(percent * (tier - last_tier));
    total += words;
    last_tier = tier;
  });
  $("h1").html(total + " слов");
  console.log(results);
}

$(document).ready(function() {
  $("#yes").bind('click', yes);
  $("#no").bind('click', no);

  $.ajax({
    url: '/list.php',
    type: 'GET',
    dataType: 'json',
    success: function(data, status, xhr) {
      var index = 0;
      $.each(data, function(key, value) {
        tiers.push(key);
        all_items.push(new Array());
        $.each(value, function(i, word) {
          all_items[index].push(word.words);
        });
        index++;
      });
      start();
      console.log(data);
    }
  });
});