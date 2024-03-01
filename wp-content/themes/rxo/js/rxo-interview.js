
var url = "//www.sejda.com/js/sejda-js-api.min.js";
$.getScript(url, function () {
    console.log('include js');
});

var UserInterviewID = 0;
function formSubmit(e) {
    var jobLocation = document.getElementById('id_job_location').value;
    var jobTitle = document.getElementById('id_job_title').value;
    var candidateType = document.getElementById('id_candidate_type').value;
    var jobFunction = document.getElementById('id_job_function').value;
    var panelInterview = document.getElementById('id_panel_interview').value;

    if (jobLocation == '' || jobTitle == '' || candidateType == '' || jobFunction == '' || panelInterview == '') {
        alert("Please Fill Interview Questionnaire Form Required Details");
        return false;
    }

    $("#display_job_location").html(jobLocation);
    $("#display_job_title").html(jobTitle);
    $("#display_candidate_type").html(candidateType);
    $("#display_job_function").html(jobFunction);
    $("#display_panel_interview").html(panelInterview);

    $("#display_job_location1").html(jobLocation);
    $("#display_job_title1").html(jobTitle);
    $("#display_candidate_type1").html(candidateType);
    $("#display_job_function1").html(jobFunction);
    $("#display_panel_interview1").html(panelInterview);
    populateValue();
}


function populateValue() {
    document.getElementById('block1').classList.add('d-none');
    document.getElementById('block2').classList.remove('d-none');
    document.getElementById('block3').classList.remove('d-none');
}

function formBackSubmit(e) {
    populateBackValue();
}

function populateBackValue() {
    document.getElementById('block1').classList.remove('d-none');
    document.getElementById('block2').classList.remove('d-none');
    document.getElementById('block3').classList.remove('d-none');
}

function CopyToClipboard(id) {
    var r = document.createRange();
    r.selectNode(document.getElementById(id));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
}

var mainListDataId = [];
var mainListDataName = [];
var mainListDataDesc = [];

$(document).ready(function () {
    $("button.js-add-capability-button").click(function () {
        var dataId = $(this).attr("data-capability-id");
        var dataName = $(this).attr("data-capability-name");
        var dataDesc = $(this).attr("data-capability-description");

        mainListDataId.push(dataId);
        mainListDataName.push(dataName);

        $(this).siblings('ul').removeClass('d-none');
        $(this).addClass('disabled');

        $("#capability" + dataId).append('<h4 class="mb-2 p-0">' + dataName + '</h4>');
        $("#capability" + dataId).append('<div class="align-items-baseline d-flex"><a href="javascript:void(0);" data-id="' + dataId + '" data-name="' + dataName + '" class="js-remove-section bg-transparent border-0 btn p-0"></a><p class="ps-1">' + dataDesc + '</p></div>');
        $("#capability" + dataId).append('<h5 class="mb-2 pb-0 border-top">QUESTIONS</h5>');
    });
});

var QuestionListDataId = [];
var QuestionListDataQuestionId = [];
var QuestionListDataQuestionName = [];
var QuestionListDataQuestionDesc = [];

$(document).ready(function () {
    $("button.js-add-primary-question-button").click(function () {
        var dataId = $(this).attr("data-capability-id");
        var dataQuestionId = $(this).attr("data-primary-question-id");
        var dataQuestionName = $(this).html();
        var dataQuestionDesc = $(this).siblings('ul').html();

        QuestionListDataId.push(dataId);
        QuestionListDataQuestionId.push(dataQuestionId);
        QuestionListDataQuestionName.push(dataQuestionName);
        QuestionListDataQuestionDesc.push(dataQuestionDesc);

        $(this).addClass('disabled');

        $("#capability" + dataId).append('<div id="questiontitle' + dataQuestionId + '" class="questiontitle align-items-baseline d-flex"><a href="javascript:void(0);" data-id="' + dataId + '" data-qid="' + dataQuestionId + '" class="js-remove-question btn p-0 bg-transparent border-0 text-start"></a><p class="ps-1">' + dataQuestionName + '</p></div>');
        $("#capability" + dataId).append('<div id="questiondesc' + dataQuestionId + '" class="questiondesc ps-5"><ul>' + dataQuestionDesc + '</ul></div>');
    });
});

$(document).ready(function () {
    $(document.body).on('click', 'a.js-remove-section', function () {
        var dataId = $(this).attr("data-id");
        var dataName = $(this).attr("data-name");

        removeItem(mainListDataId, dataId);
        removeItem(mainListDataName, dataName);

        $("#capability" + dataId).empty();

        $('[data-capability-id="' + dataId + '"]').siblings('ul').addClass('d-none');
        $('[data-capability-id="' + dataId + '"]').removeClass('disabled');
    });
});

$(document).ready(function () {
    $(document.body).on('click', 'a.js-remove-question', function () {
        var dataId = $(this).attr("data-id");
        var dataQuestionId = $(this).attr("data-qid");

        var itemkey = getItemkey(QuestionListDataQuestionId, dataQuestionId);

        removeItembykey(QuestionListDataId, itemkey);
        removeItembykey(QuestionListDataQuestionId, itemkey);
        removeItembykey(QuestionListDataQuestionName, itemkey);
        removeItembykey(QuestionListDataQuestionDesc, itemkey);

        $("#questiontitle" + dataQuestionId).remove();
        $("#questiondesc" + dataQuestionId).remove();

        $('[data-primary-question-id="' + dataQuestionId + '"]').siblings('ul').addClass('d-none');
        $('[data-primary-question-id="' + dataQuestionId + '"]').removeClass('disabled');
    });
});

function formPDFCSubmit() {
    document.getElementById('block1').classList.add('d-none');
    document.getElementById('block2').classList.add('d-none');
    document.getElementById('block3').classList.add('d-none');
    document.getElementById('block5').classList.remove('d-none');

    window.scroll({top: 0, left: 0, behavior: 'smooth'});

    for (let i = 0; i < mainListDataName.length; i++) {
        newItem(i);
    }

    ratingItem(mainListDataName);

    var UserDataJSON = [];
    for (let j = 0; j < mainListDataName.length; j++) {
        var Id = mainListDataId[j];
        var Name = mainListDataName[j];

        var UserQuestionDataJSON = [];
        for (let k = 0; k < QuestionListDataId.length; k++) {
            if (Id == QuestionListDataId[k]) {
                var QId = QuestionListDataQuestionId[k];
                var QName = QuestionListDataQuestionName[k];
                var QDesc = QuestionListDataQuestionDesc[k];
                var UserQuestionDataArray = QId;
                UserQuestionDataJSON.push(UserQuestionDataArray);
            }
        }

        var UserDataArray = '{"id":"' + Id + '","name":"' + Name + '","questions":"' + UserQuestionDataJSON + '"}';
        UserDataJSON.push(UserDataArray);
    }

    var pdfContent = $("#block3").html();

    setTimeout(function () {
        var element = $("#block4").html();
        var HTMLelement = '<html><body style="margin: 0 auto;width: 1000px;padding:0px;"><link rel="stylesheet" href="' + window.location.origin + '/wp-content/themes/spinco/css/all.css" media="all">' + element + '</body></html>';

        SejdaJsApi.htmlToPdf({
            filename: 'RXO-Interview-Questionnaire.pdf',
            pageSize: 'letter',
            pageOrientation: 'portrait',
            pageMargin: '50',
            pageMarginUnits: 'px',
            publishableKey: 'api_public_dd7d5a4a65084f3d88952003d87a2cac',
            htmlCode: HTMLelement,
            always: function () {
                document.getElementById('downloading').classList.add('d-none');

                // var UserDataString = JSON.stringify(UserDataJSON);
                // var jobLocation = document.getElementById('id_job_location').value;
                // var jobTitle = document.getElementById('id_job_title').value;
                // var candidateType = document.getElementById('id_candidate_type').value;
                // var jobFunction = document.getElementById('id_job_function').value;
                // var PDFStatus = 1;

                // UserInterviewID = CreateInterviewQuestion(jobLocation, jobTitle, candidateType, jobFunction, UserDataString, PDFStatus);
                //console.log('CreateInterviewQuestion-Sucess');

            },
            error: function (err) {
                console.error(err);

                // var UserDataString = JSON.stringify(UserDataJSON);
                // var jobLocation = document.getElementById('id_job_location').value;
                // var jobTitle = document.getElementById('id_job_title').value;
                // var candidateType = document.getElementById('id_candidate_type').value;
                // var jobFunction = document.getElementById('id_job_function').value;
                // var PDFStatus = 0;

                // UserInterviewID = CreateInterviewQuestion(jobLocation, jobTitle, candidateType, jobFunction, UserDataString, PDFStatus);
                //console.log('CreateInterviewQuestion-Failure');
            }
        });
    }, 6000);
}

function newItem(Key) {
    var Id = mainListDataId[Key];
    var Name = mainListDataName[Key];

    newInput = '';
    newInput += '<div class="PDF-header-section">';
    newInput += '<img height="24" src="' + window.location.origin + '/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">';
    newInput += '<p class="text-center p-3">Interview Guide</p>';
    newInput += '</div>';
    newInput += '<h1 class="PDF-subtitle text-center text-decoration-underline text-uppercase m-2 p-2 fs-4">Behavioral Based Questions</h1>';
    newInput += '<table class="PDF-table PDF-table--noSpacing">';
    newInput += '<thead>';
    newInput += '<tr>';
    newInput += '<th class="PDF-cell PDF-cellHeader" colspan="3">';
    newInput += '<h1 class="text-black text-center p-0 m-0 fs-4">' + Name + '</h1>';
    newInput += '</th>'
    newInput += '</tr>';

    var qic = 0;
    for (q = 0; q < QuestionListDataId.length; q++) {
        if (QuestionListDataId[q] == Id) {
            qic++;
            newInput += '<tr>';
            newInput += '<td class="PDF-cell" colspan="3">';
            newInput += 'Q' + qic + ':&nbsp;&nbsp;' + QuestionListDataQuestionName[q] + '';
            newInput += '<ul class="PDF-list PDF-question-list px-5 mx-5 pb-0 mb-0 pt-2">' + QuestionListDataQuestionDesc[q] + '</ul>';
            newInput += '</td>';
            newInput += '</tr>';
        }
    }
    newInput += '</thead>';
    newInput += '</table>';

    if (qic > 2) {
        newInput += '<div class="html2pdf__page-break"></div>';
        newInput += '<div class="with-page-break"></div>';
        newInput += '<div class="PDF-header-section">';
        newInput += '<img height="24" src="' + window.location.origin + '/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">';
        newInput += '<p class="text-center p-3">Interview Guide</p>';
        newInput += '</div>';
    }

    newInput += '<table class="PDF-table PDF-table--noSpacing">';
    newInput += '<tbody>';
    newInput += '<tr>';
    newInput += '<td class="PDF-cell PDF-cellHeader fs-4"><span class="text-black text-center p-0 m-0 fs-4">SITUATION</span></td>';
    newInput += '<td class="PDF-cell PDF-cellHeader fs-4"><span class="text-black text-center p-0 m-0 fs-4">ACTION TAKEN</span></td>';
    newInput += '<td class="PDF-cell PDF-cellHeader fs-4"><span class="text-black text-center p-0 m-0 fs-4">RESULT</span></td>';
    newInput += '</tr>';
    newInput += '<tr>';
    newInput += '<td class="PDF-cell PDF-userEntryCell--huge">&nbsp;</td>';
    newInput += '<td class="PDF-cell PDF-userEntryCell--huge">&nbsp;</td>';
    newInput += '<td class="PDF-cell PDF-userEntryCell--huge">&nbsp;</td>';
    newInput += '</tr>';
    newInput += '</tbody>';
    newInput += '</table>';
    newInput += '<table class="PDF-table">';
    newInput += '<tbody>';
    newInput += '<tr>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">1</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">2</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">3</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">4</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">5</td>';
    newInput += '</tr>';
    newInput += '<tr class="PDF-checkboxes">';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center"><span class="PDF-checkbox">&nbsp;</span></td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center"><span class="PDF-checkbox">&nbsp;</span></td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center"><span class="PDF-checkbox">&nbsp;</span></td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center"><span class="PDF-checkbox">&nbsp;</span></td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center"><span class="PDF-checkbox">&nbsp;</span></td>';
    newInput += '</tr>';
    newInput += '<tr>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center" colspan="2">Little to No Demonstration of Capability</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center">Demonstrates Capability</td>';
    newInput += '<td class="PDF-cell PDF-cell--highlighted text-center" colspan="2">Consistently Demonstrates Capability</td>';
    newInput += '</tr>';
    newInput += '</tbody>';
    newInput += '</table>';
    newInput += '<div class="html2pdf__page-break"></div>';
    newInput += '<div class="with-page-break"></div>';
    $("#behavioralcontenthere").append(newInput);
}


function ratingItem(Name) {
    newInput = '';
    newInput += '<table class="PDF-table PDF-table--small">';
    newInput += '<thead>';
    newInput += '<tr>';
    newInput += '<th class="PDF-cell PDF-cellHeader"><h1 class="text-black text-center p-0 m-0 fs-4">Capability</h1></th>';
    newInput += '<th class="PDF-cell PDF-cellHeader"><h1 class="text-black text-center p-0 m-0 fs-4">Rating</h1></th>'
    newInput += '</tr>';
    newInput += '</thead>';
    newInput += '<tbody>';

    for (let i = 0; i < mainListDataName.length; i++) {
        newInput += '<tr>';
        newInput += '<td class="PDF-cell PDF-userEntryCell align-top">' + mainListDataName[i] + '</td>';
        newInput += '<td class="PDF-cell PDF-userEntryCell">&nbsp;</td>';
        newInput += '</tr>';
    }

    newInput += '<tr>';
    newInput += '<td class="PDF-cell PDF-userEntryCell align-top">TOTAL</td>';
    newInput += '<td class="PDF-cell PDF-userEntryCell">&nbsp;</td>';
    newInput += '</tr>';
    newInput += '</tbody>';
    newInput += '</table>';

    if (mainListDataName.length > 2) {
        newInput += '<div class="html2pdf__page-break"></div>';
        newInput += '<div class="with-page-break"></div>';
        newInput += '<div class="PDF-header-section">';
        newInput += '<img height="24" src="' + window.location.origin + '/wp-content/themes/spinco/images/rxo-logo.svg" class="custom-logo" alt="RXO | Massive capacity. Cutting-edge technology.">';
        newInput += '<p class="text-center p-3">Interview Guide</p>';
        newInput += '</div>';
    }
    $("#ratingcontenthere").append(newInput);
}

function getItemkey(array, item) {
    for (var i in array) {
        if (array[i] == item) {
            return i;
        }
    }
}

function removeItem(array, item) {
    for (var i in array) {
        if (array[i] == item) {
            array.splice(i, 1);
            break;
        }
    }
}

function removeItembykey(array, item) {
    array.splice(item, 1);
}

    // function CreateInterviewQuestion(jobLocation, jobTitle, candidateType, jobFunction, UserDataString = '', PDFStatus) {
    //     var UserInterviewID = 0;
    //     var data = {
    //         'action': 'create_interview_usage',
    //         'nonce': rxo_interview.nonce,
    //         'int_qu_usage_job_location': jobLocation,
    //         'int_qu_usage_job_title': jobTitle,
    //         'int_qu_usage_candidate_type': candidateType,
    //         'int_qu_usage_job_function': jobFunction,
    //         'int_qu_usage_questions': UserDataString,
    //         'int_qu_usage_status': PDFStatus
    //     };

    //     var ajaxurl = rxo_interview.ajaxurl;
    //     jQuery.post(ajaxurl, data, function (response) {
    //         localStorage.setItem("UserInterviewID", response);
    //         if (response != undefined) {
    //             UserInterviewID = response;
    //             return UserInterviewID;
    //         }
    //     });
    // }