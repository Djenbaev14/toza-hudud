
<script>
  $(document).ready(function () {
var num = $(".property-fields__row").length;
if (num - 1 == 0) $("#btnDel").attr("disabled", "disabled");

$("#btnAdd").click(function () {
  var num = $(".property-fields__row").length;
  var newNum = num + 1;
  var newElem = $("#property-fields__row-1")
    .clone()
    .attr("id", "property-fields__row-" + newNum);


    newElem
    .find(".line-item-property__year label")
    .attr("for", "product_id_" + newNum)
    .val("");
  newElem
    .find(".line-item-property__year input")
    .attr("id", "product_id_" + newNum)
    .attr("name", "properties["+newNum+"][product_id]")
    .val("");

    newElem
    .find(".line-item-property__team label")
    .attr("for", "price_" + newNum)
    .val("");
  newElem
    .find(".line-item-property__team input")
    .attr("id", "price_" + newNum)
    .attr("name", "properties["+newNum+"][price]")
    .val("");

  newElem
    .find(".line-item-property__name label")
    .attr("for", "quantity" + newNum)
    .val("");
  newElem
    .find(".line-item-property__name input")
    .attr("id", "quantity" + newNum)
    .attr("name", "properties["+newNum+"][quantity]" )
    .val("");

  $("#property-fields__row-" + num).after(newElem);

  $("#btnDel").attr("disabled", false);

  if (newNum == 19) $("#btnAdd").attr("disabled", "disabled");
});

$("#btnDel").click(function () {
  var num = $(".property-fields__row").length;

  $("#property-fields__row-" + num).remove();

  $("#btnAdd").attr("disabled", false);

  if (num - 1 == 1) $("#btnDel").attr("disabled", "disabled");
});
});

</script>


<style>
  .property-fields__row {
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 100%;
-webkit-flex-wrap: wrap;
-moz-flex-wrap: wrap;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
-ms-flex-align: end;
-webkit-align-items: flex-end;
-moz-align-items: flex-end;
-ms-align-items: flex-end;
-o-align-items: flex-end;
align-items: flex-end;
width: auto;
margin: 0 -5px 10px;

& > .line-item-property__field {
-webkit-flex: 1 1 33%;
-moz-flex: 1 1 33%;
-ms-flex: 1 1 33%;
-o-flex: 1 1 33%;
flex: 1 1 33%;
padding-left: 5px;

&.line-item-property__year {
  -webkit-flex: 1 1 20%;
  -moz-flex: 1 1 20%;
  -ms-flex: 1 1 20%;
  -o-flex: 1 1 20%;
  flex: 1 1 20%;
}

input {
  margin: 0;
  width: 90%;
}
}
}


</style>