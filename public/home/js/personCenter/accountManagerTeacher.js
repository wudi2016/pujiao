/**
 * Created by LT on 2017/1/16.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//个人中心选项卡切换
$(".account_common").click(function () {
    $(this).addClass('blue_common');
    $(this).siblings().removeClass('blue_common');
});

//url定位选项卡
var href = location.href.split('#');
var tem = href[0].split('/');
var url = '';

//教师

if (href[1]) {
    url = href[1];
} else {
    url = 'bindSubject';
}


$("div[name='" + url + "']").addClass('blue_common');
$("div[name='" + url + "']").siblings().removeClass('blue_common');


//hover
$(".account_common").hover(
    function () {
        $(this).addClass("active_hover").prev('span').addClass('span_active');
    },
    function () {
        $(this).removeClass("active_hover").prev('span').removeClass('span_active');

    });

//头像编辑框 显示
$('.upload_img_text').click(function () {
    $('.headImg').removeClass('hide');
});

$('.headImg_tit_r').click(function () {
    $('.headImg').addClass('hide');
});

//头像上传
var uploadify_onSelectError = function (file, errorCode, errorMsg) {
    var msgText = "上传失败\n";
    switch (errorCode) {
        case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
            //this.queueData.errorMsg = "每次最多上传 " + this.settings.queueSizeLimit + "个文件";
            msgText += "每次最多上传 " + this.settings.queueSizeLimit + "个文件";
            break;
        case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
            msgText += "文件大小超过限制( " + this.settings.file_size_limit + " )";
            break;
        case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
            msgText += "文件大小为0";
            break;
        case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
            msgText += "文件格式不正确，仅限 " + this.settings.file_types;
            break;
        default:
            msgText += "错误代码：" + errorCode + "\n" + errorMsg;
    }
    alert(msgText);
};


//上传头像
var img = '';
var imgb = '';
var imgc = '';

var x = 0;
var y = 0;
var w = 0;
var h = 0;

var imgsrc = '';
//个人头像
$('#file_upload').uploadify({
    'swf': '/home/css/personCenter/uploadify.swf',
    'uploader': '/member/addImg',
    'buttonText': '选择图片',
    'post_params': {
        '_token': $('meta[name="csrf-token"]').attr('content')
    },
    'file_size_limit': '5MB',
    'file_types': " *.jpg;*.png;*.jpeg;*.bmp;*.pdf;*.ico;*.gif ",
    'overrideEvents': ['onSelectError'],
    'onSelectError': uploadify_onSelectError,
    'onUploadSuccess': function (file, data, response) {
        var data = eval("(" + data + ")");
        imgsrc = data.src;
        img = "<img id=\"imghead\" src='" + data.src + "'>";
        imgb = "<img id=\"preview\" src='" + data.src + "'>";
        imgc = "<img id=\"preview2\" src='" + data.src + "'>";
        $('#imgs').html(img);
        $('#imgsb').html(imgb);
        $('#imgsc').html(imgc);

        w = 0;
        cutImg(data.width, data.height);
    }
});

function cutImg(boundx, boundy) {

    jQuery('#imghead').Jcrop({
        aspectRatio: 1,
        onSelect: showPreview, //选中区域时执行对应的回调函数
        onChange: showPreview, //选择区域变化时执行对应的回调函数
    });

    function showPreview(coords) {
        var rx = 60 / coords.w;
        var ry = 60 / coords.h;
        var rx2 = 100 / coords.w;
        var ry2 = 100 / coords.h;

        $('#preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });

        $('#preview2').css({
            width: Math.round(rx2 * boundx) + 'px',
            height: Math.round(ry2 * boundy) + 'px',
            marginLeft: '-' + Math.round(rx2 * coords.x) + 'px',
            marginTop: '-' + Math.round(ry2 * coords.y) + 'px'
        });

        //jQuery('#x').val(coords.x); //选中区域左上角横
        //jQuery('#y').val(coords.y); //选中区域左上角纵坐标
        //jQuery("#x2").val(coords.x2); //选中区域右下角横坐标
        //jQuery("#y2").val(coords.y2); //选中区域右下角纵坐标
        //jQuery('#w').val(coords.w); //选中区域的宽度
        //jQuery('#h').val(coords.h); //选中区域的高度

        x = coords.x;
        y = coords.y;
        w = coords.w;
        h = coords.h;

    }


}

function checkCoords() {
    if (w > 0) return true;
    alert('请选择需要裁切的图片区域.');
    return false;
}

$('.saveImg').click(function () {
    if (checkCoords()) {
        $.ajax({
            type: "post",
            url: "/member/cutImg",
            data: {imgsrc: imgsrc, x: x, y: y, w: w, h: h},
            async: false,
            success: function (data) {
                if (data == 1) {
                    //history.go(0);
                    location.reload();
                } else {
                    alert('修改失败');
                }
            }
        });
    }
});


//新增 -- 绑定学科
$("#id_label_single").select2({
    ajax: {
        url: "/member/getBindSubjects",
        type: 'post',
        data: {table: 'schoolgrade', action: 1, column: 'grade'},
        dataType: 'json',
        processResults: function (data) {
            return {
                results: data.data
            };
        }
    }
});
//获取科目
function getSubject(value) {
    $("#id_label_single1").prepend('<option value="" selected="selected">--科目--</option>');
    $("#id_label_single1").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {table: 'studysubject', action: 1, column: 'subject', data: {gradeId: value,}},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}
//获取册别
function getBook(value) {
    $("#id_label_single2").prepend('<option value="" selected="selected">--册别--</option>');
    var gradeId = $("#id_label_single").val();
    $("#id_label_single2").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {table: 'studyebook', action: 1, column: 'book', data: {gradeId: gradeId, subjectId: value}},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}
//获取版本
function getEdition(value) {
    $("#id_label_single3").prepend('<option value="" selected="selected">--版本--</option>');
    var gradeId = $("#id_label_single").val();
    var subjectId = $("#id_label_single1").val();
    $("#id_label_single3").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {
                table: 'studyedition',
                action: 1,
                column: 'edition',
                data: {gradeId: gradeId, subjectId: subjectId, bookId: value}
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
};

//修改绑定学科 -- onchange
function getSubject1(value) {
    $(".subject").prepend('<option value="" selected="selected">--科目--</option>');
    $(".subject").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {table: 'studysubject', action: 1, column: 'subject', data: {gradeId: value}},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}
//获取册别//修改绑定学科 -- onchange
function getBook1(value) {
    $(".book").prepend('<option value="" selected="selected">--册别--</option>');
    var gradeId = $(".grade").val();
    $(".book").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {table: 'studyebook', action: 1, column: 'book', data: {gradeId: gradeId, subjectId: value}},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}
//获取版本//修改绑定学科 -- onchange
function getEdition1(value) {
    $(".edition").prepend('<option value="" selected="selected">--版本--</option>');
    var gradeId = $(".grade").val();
    var subjectId = $(".subject").val();
    $(".edition").select2({
        ajax: {
            url: "/member/getBindSubjects",
            type: 'post',
            data: {
                table: 'studyedition',
                action: 1,
                column: 'edition',
                data: {gradeId: gradeId, subjectId: subjectId, bookId: value}
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}

//新增任课
//获取年级
$("#id_label_single4").select2({
    ajax: {
        url: "/member/bindSubjectsInfo",
        type: 'post',
        data: {table: 'teachersubject', action: 1, type: 1},
        dataType: 'json',
        processResults: function (data) {
            return {
                results: data.data
            };
        }
    }
});
//获取班
function getClass(value) {
    $("#id_label_single5").prepend('<option value="" selected="selected">--班--</option>');
    $("#id_label_single5").select2({
        ajax: {
            url: "/member/bindSubjectsInfo",
            type: 'post',
            data: {table: 'teachersubject', action: 1, type: 2, data: value},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
    //科目
    $("#id_label_single6").select2({
        ajax: {
            url: "/member/bindSubjectsInfo",
            type: 'post',
            data: {table: 'teachersubject', action: 1, type: 3 , data: value},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}

//新增任课 -- 修改
function getClass1(value) {
    $(".id_label_single5").prepend('<option value="" selected="selected">--班--</option>');
    $(".id_label_single6").prepend('<option value="" selected="selected">--科目--</option>');
    $(".id_label_single5").select2({
        ajax: {
            url: "/member/bindSubjectsInfo",
            type: 'post',
            data: {table: 'teachersubject', action: 1, type: 2, data: value},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
    //科目
    $(".id_label_single6").select2({
        ajax: {
            url: "/member/bindSubjectsInfo",
            type: 'post',
            data: {table: 'teachersubject', action: 1, type: 3 , data: value},
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data
                };
            }
        }
    });
}
document.getElementById("shadow").addEventListener("wheel", function(e) {
    e.preventDefault();
});