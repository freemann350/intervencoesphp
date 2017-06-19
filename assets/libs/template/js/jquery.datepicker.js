$('#datepicker-registos .input-group.date').datepicker({
  format: "dd/mm/yyyy",
  todayBtn: "linked",
  language: "pt",
  autoclose: true,
  todayHighlight: true,
  startDate: "01-01-2017",
  daysOfWeekDisabled: [0,6],
  endDate: "today"
});

$('.input-daterange').datepicker({
  format: "dd/mm/yyyy",
  todayBtn: "linked",
  language: "pt",
  autoclose: true,
  todayHighlight: true
});
