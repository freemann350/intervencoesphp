$('#datepicker-registos .input-group.date').datepicker({
  format: "dd/mm/yyyy",
  todayBtn: "linked",
  language: "pt",
  autoclose: true,
  todayHighlight: true,
  daysOfWeekDisabled: "0,6",
  daysOfWeekHighlighted: "0,6",
  startDate: "01-01-2017",
  endDate: "today"
});

$('.input-daterange').datepicker({
  format: "dd/mm/yyyy",
  todayBtn: "linked",
  language: "pt",
  autoclose: true,
  todayHighlight: true
});
