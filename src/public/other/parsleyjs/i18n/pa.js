// ParsleyConfig definition if not already set
window.ParsleyConfig = window.ParsleyConfig || {};
window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

// Define then the messages
window.ParsleyConfig.i18n.pa = jQuery.extend(window.ParsleyConfig.i18n.pa || {}, {
    defaultMessage: "دغه اندازه صحیح نه دي",
    type: {
        email:        "دغه اندازه باید یو معتبر برښنالیک وي",
        url:          "دغه اندازه باید یو معتبر آدرس وي",
        number:       "دغه اندازه باید یوه معتبره شمیره وي",
        integer:      "دغه اندازه باید یوه صحیح معتبره شمیره وي ",
        digits:       "دغه اندازه باید یوه شمیره وي",
        alphanum:     "دغه اندازه باید دالفبا حروف وي"
    },
    notblank:       "دغه اندازه باید خالی نه وي",
    required:       "دغه اندازه باید وړاندي شي",
    pattern:        "دغه اندازه چي په نظر راځي معتبر نه دي ",
    min:            "دغه اندازه باید لوړه يا مساوی %s وي",
    max:            "دغه اندازه باید لږ او یا مساوی %s وي",
    range:          "دغه اندازه باید مینځ %s او %s وي",
    minlength:      "دغه اندازه له حد نه وړوکي دي او باید %s بله اندازه وړاندي شي",
    maxlength:      "دغه اندازه له حد نه لویه دي او لازمه ده  %s اندازه  لږه شي",
    length:         "دغه اندازه معتبر نه دي او باید مینځ %s او %s وي",
    mincheck:       "باید لږ s% انتخاب شي",
    maxcheck:       "باید حداقل %s انتخاب شي",
    check:          "باید مینځ %s و %s انتخاب کړې",
    equalto:        "دغه اندازه باید یوشان وي"
});

// If file is loaded after Parsley main file, auto-load locale
if ('undefined' !== typeof window.ParsleyValidator)
    window.ParsleyValidator.addCatalog('pa', window.ParsleyConfig.i18n.pa, true);