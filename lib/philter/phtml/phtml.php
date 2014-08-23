<?php

function phattrs($attr) { return new PhilterAttribute($attr, PhilterAttribute::ATTR_STR); }
function phattrb($attr) { return new PhilterAttribute($attr, PhilterAttribute::ATTR_BOOL); }
function phattri($attr) { return new PhilterAttribute($attr, PhilterAttribute::ATTR_INT); }
function phattrn($attr) { return new PhilterAttribute($attr, PhilterAttribute::ATTR_NUM); }

class PhilterHtmlA extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('download'),
            phattrs('href'),
            phattrs('media'),
            phattrs('ping'),
            phattrs('rel'),
            phattrs('target'),
            phattrs('hreflang'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'a'; }
}

class PhilterHtmlAbbr extends PhilterHtml {
    protected function getTag() { return 'abbr'; }
}

class PhilterHtmlAddress extends PhilterHtml {
    protected function getTag() { return 'address'; }
}

class PhilterHtmlArea extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('alt'),
            phattrs('coords'),
            phattrs('download'),
            phattrs('href'),
            phattrs('hreflang'),
            phattrs('media'),
            phattrs('rel'),
            phattrs('shape'),
            phattrs('target'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'area'; }
}

class PhilterHtmlArticle extends PhilterHtml {
    protected function getTag() { return 'article'; }
}

class PhilterHtmlAside extends PhilterHtml {
    protected function getTag() { return 'aside'; }
}

class PhilterHtmlAudio extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('autoplay'),
            phattrb('controls'),
            phattrb('loop'),
            phattrb('muted'),
            phattrs('preload'),
            phattrn('volume'),
        );
    }

    protected function getTag() { return 'audio'; }
}

class PhilterHtmlB extends PhilterHtml {
    protected function getTag() { return 'b'; }
}

class PhilterHtmlBase extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('href'),
            phattrs('target'),
        );
    }

    protected function getTag() { return 'base'; }
}

class PhilterHtmlBdi extends PhilterHtml {
    protected function getTag() { return 'bdi'; }
}

class PhilterHtmlBdo extends PhilterHtml {
    protected function getTag() { return 'bdo'; }
}

class PhilterHtmlBlockquote extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('cite'),
        );
    }

    protected function getTag() { return 'blockquote'; }
}

class PhilterHtmlBody extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('onafterprint'),
            phattrs('onbeforeprint'),
            phattrs('onbeforeunload'),
            phattrs('onblur'),
            phattrs('onerror'),
            phattrs('onfocus'),
            phattrs('onhashchange'),
            phattrs('onload'),
            phattrs('onmessage'),
            phattrs('onoffline'),
            phattrs('ononline'),
            phattrs('onpopstate'),
            phattrs('onredo'),
            phattrs('onresize'),
            phattrs('onstorage'),
            phattrs('ononundo'),
            phattrs('onerror'),
            phattrs('onunload'),
        );
    }

    protected function getTag() { return 'body'; }
}

class PhilterHtmlBr extends PhilterHtml {
    protected function getTag() { return 'br'; }
}

class PhilterHtmlButton extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('autofocus'),
            phattrb('disabled'),
            phattrs('form'),
            phattrs('formaction'),
            phattrs('formenctype'),
            phattrs('formmethod'),
            phattrb('formnovalidate'),
            phattrs('formtarget'),
            phattrs('name'),
            phattrs('type'),
            phattrs('value'),
        );
    }

    protected function getTag() { return 'button'; }
}

class PhilterHtmlCanvas extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('width'),
            phattri('height'),
        );
    }

    protected function getTag() { return 'canvas'; }
}

class PhilterHtmlCaption extends PhilterHtml {
    protected function getTag() { return 'caption'; }
}

class PhilterHtmlCite extends PhilterHtml {
    protected function getTag() { return 'cite'; }
}

class PhilterHtmlCode extends PhilterHtml {
    protected function getTag() { return 'code'; }
}

class PhilterHtmlCol extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('span'),
        );
    }

    protected function getTag() { return 'col'; }
}

class PhilterHtmlColgroup extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('span'),
        );
    }

    protected function getTag() { return 'colgroup'; }
}

class PhilterHtmlData extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('value'),
        );
    }

    protected function getTag() { return 'data'; }
}

class PhilterHtmlDatalist extends PhilterHtml {
    protected function getTag() { return 'datalist'; }
}

class PhilterHtmlDd extends PhilterHtml {
    protected function getTag() { return 'dd'; }
}

class PhilterHtmlDel extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('cite'),
            phattrs('datetime'),
        );
    }

    protected function getTag() { return 'del'; }
}

class PhilterHtmlDetails extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('open'),
        );
    }

    protected function getTag() { return 'details'; }
}

class PhilterHtmlDfn extends PhilterHtml {
    protected function getTag() { return 'dfn'; }
}

class PhilterHtmlDiv extends PhilterHtml {
    protected function getTag() { return 'div'; }
}

class PhilterHtmlDl extends PhilterHtml {
    protected function getTag() { return 'dl'; }
}

class PhilterHtmlDt extends PhilterHtml {
    protected function getTag() { return 'dt'; }
}

class PhilterHtmlEm extends PhilterHtml {
    protected function getTag() { return 'em'; }
}

class PhilterHtmlEmbed extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('height'),
            phattrs('src'),
            phattrs('type'),
            phattri('width'),
        );
    }

    protected function getTag() { return 'embed'; }
}

class PhilterHtmlFieldset extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('disabled'),
            phattrs('form'),
            phattrs('name'),
        );
    }

    protected function getTag() { return 'fieldset'; }
}

class PhilterHtmlFigcaption extends PhilterHtml {
    protected function getTag() { return 'figcaption'; }
}

class PhilterHtmlFigure extends PhilterHtml {
    protected function getTag() { return 'figure'; }
}

class PhilterHtmlFooter extends PhilterHtml {
    protected function getTag() { return 'footer'; }
}

class PhilterHtmlForm extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('accept-charset'),
            phattrs('action'),
            phattrs('autocomplete'),
            phattrs('enctype'),
            phattrs('method'),
            phattrs('name'),
            phattrb('novalidate'),
            phattrs('formtarget'),
            phattrs('target'),
        );
    }

    protected function getTag() { return 'form'; }
}

class PhilterHtmlH1 extends PhilterHtml {
    protected function getTag() { return 'h1'; }
}

class PhilterHtmlH2 extends PhilterHtml {
    protected function getTag() { return 'h2'; }
}

class PhilterHtmlH3 extends PhilterHtml {
    protected function getTag() { return 'h3'; }
}

class PhilterHtmlH4 extends PhilterHtml {
    protected function getTag() { return 'h4'; }
}

class PhilterHtmlH5 extends PhilterHtml {
    protected function getTag() { return 'h5'; }
}

class PhilterHtmlH6 extends PhilterHtml {
    protected function getTag() { return 'h6'; }
}

class PhilterHtmlHead extends PhilterHtml {
    protected function getTag() { return 'head'; }
}

class PhilterHtmlHeader extends PhilterHtml {
    protected function getTag() { return 'header'; }
}

class PhilterHtmlHr extends PhilterHtml {
    protected function getTag() { return 'hr'; }
}

class PhilterHtmlHtml extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('manifest'),
            phattrs('xmlns'),
        );
    }

    protected function getTag() { return 'html'; }
}

class PhilterHtmlI extends PhilterHtml {
    protected function getTag() { return 'i'; }
}

class PhilterHtmlIframe extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('allowfullscreen'),
            phattri('height'),
            phattrs('name'),
            phattrs('sandbox'),
            phattrb('seamless'),
            phattrs('src'),
            phattrs('srcdoc'),
            phattri('width'),
        );
    }

    protected function getTag() { return 'iframe'; }
}

class PhilterHtmlImg extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('alt'),
            phattrs('crossorigin'),
            phattri('height'),
            phattrb('ismap'),
            phattrs('src'),
            phattrs('srcset'),
            phattri('width'),
            phattrs('usemap'),
        );
    }

    protected function getTag() { return 'img'; }
}

class PhilterHtmlInput extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('type'),
            phattrs('accept'),
            phattrs('autocomplete'),
            phattrb('autofocus'),
            phattrs('autosave'),
            phattrb('checked'),
            phattrb('disabled'),
            phattrs('form'),
            phattrs('formaction'),
            phattrs('formenctype'),
            phattrs('formmethod'),
            phattrb('formnovalidate'),
            phattrs('formtarget'),
            phattri('height'),
            phattrs('inputmode'),
            phattrs('list'),
            phattrs('max'),
            phattri('maxlength'),
            phattrs('min'),
            phattri('minlength'),
            phattrb('multiple'),
            phattrs('name'),
            phattrs('pattern'),
            phattrs('placeholder'),
            phattrb('readonly'),
            phattrb('required'),
            phattrs('selectionDirection'),
            phattri('size'),
            phattrs('spellcheck'),
            phattrs('src'),
            phattrs('step'),
            phattrs('value'),
            phattri('width'),
        );
    }

    protected function getTag() { return 'input'; }
}

class PhilterHtmlIns extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('cite'),
            phattrs('datetime'),
        );
    }

    protected function getTag() { return 'ins'; }
}

class PhilterHtmlKbd extends PhilterHtml {
    protected function getTag() { return 'kbd'; }
}

class PhilterHtmlKeygen extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('autofocus'),
            phattrs('challenge'),
            phattrb('disabled'),
            phattrs('form'),
            phattrs('keytype'),
            phattrs('name'),
        );
    }

    protected function getTag() { return 'keygen'; }
}

class PhilterHtmlLabel extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('for'),
            phattrs('form'),
        );
    }

    protected function getTag() { return 'label'; }
}

class PhilterHtmlLegend extends PhilterHtml {
    protected function getTag() { return 'legend'; }
}

class PhilterHtmlLi extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('value'),
        );
    }

    protected function getTag() { return 'li'; }
}

class PhilterHtmlLink extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('crossorigin'),
            phattrs('href'),
            phattrs('hreflang'),
            phattrs('media'),
            phattrs('rel'),
            phattrs('size'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'link'; }
}

class PhilterHtmlMain extends PhilterHtml {
    protected function getTag() { return 'main'; }
}

class PhilterHtmlMap extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('name'),
        );
    }

    protected function getTag() { return 'link'; }
}

class PhilterHtmlMark extends PhilterHtml {
    protected function getTag() { return 'mark'; }
}

class PhilterHtmlMenu extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('type'),
            phattrs('label'),
        );
    }

    protected function getTag() { return 'menu'; }
}

class PhilterHtmlMenuitem extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('checked'),
            phattrs('command'),
            phattrb('default'),
            phattrb('disabled'),
            phattrs('icon'),
            phattrs('label'),
            phattrs('radiogroup'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'menuitem'; }
}

class PhilterHtmlMeta extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('charset'),
            phattrs('content'),
            phattrs('http-equiv'),
            phattrs('name'),
        );
    }

    protected function getTag() { return 'meta'; }
}

class PhilterHtmlMeter extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrn('value'),
            phattrn('min'),
            phattrn('max'),
            phattrn('low'),
            phattrn('high'),
            phattrn('optimum'),
            phattrs('form'),
        );
    }

    protected function getTag() { return 'meter'; }
}

class PhilterHtmlNav extends PhilterHtml {
    protected function getTag() { return 'nav'; }
}

class PhilterHtmlNoscript extends PhilterHtml {
    protected function getTag() { return 'noscript'; }
}

class PhilterHtmlObject extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('data'),
            phattrs('form'),
            phattri('height'),
            phattrs('name'),
            phattrs('type'),
            phattrs('usemap'),
            phattri('width'),
        );
    }

    protected function getTag() { return 'object'; }
}

class PhilterHtmlOl extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('reversed'),
            phattri('start'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'ol'; }
}

class PhilterHtmlOptgroup extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('disabled'),
            phattrs('label'),
        );
    }

    protected function getTag() { return 'optgroup'; }
}

class PhilterHtmlOption extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('disabled'),
            phattrs('label'),
            phattrb('selected'),
            phattrs('value'),
        );
    }

    protected function getTag() { return 'option'; }
}

class PhilterHtmlOutput extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('for'),
            phattrs('form'),
            phattrs('name'),
        );
    }

    protected function getTag() { return 'output'; }
}

class PhilterHtmlP extends PhilterHtml {
    protected function getTag() { return 'p'; }
}

class PhilterHtmlParam extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('name'),
            phattrs('value'),
        );
    }

    protected function getTag() { return 'param'; }
}

class PhilterHtmlPre extends PhilterHtml {
    protected function getTag() { return 'pre'; }
}

class PhilterHtmlProgress extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrn('max'),
            phattrn('value'),
        );
    }

    protected function getTag() { return 'progress'; }
}

class PhilterHtmlQ extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('cite'),
        );
    }

    protected function getTag() { return 'q'; }
}

class PhilterHtmlRp extends PhilterHtml {
    protected function getTag() { return 'rp'; }
}

class PhilterHtmlRt extends PhilterHtml {
    protected function getTag() { return 'rt'; }
}

class PhilterHtmlRuby extends PhilterHtml {
    protected function getTag() { return 'ruby'; }
}

class PhilterHtmlS extends PhilterHtml {
    protected function getTag() { return 's'; }
}

class PhilterHtmlSamp extends PhilterHtml {
    protected function getTag() { return 'samp'; }
}

class PhilterHtmlScript extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('async'),
            phattrs('src'),
            phattrs('type'),
            phattrb('defer'),
        );
    }

    protected function getTag() { return 'script'; }
}

class PhilterHtmlSection extends PhilterHtml {
    protected function getTag() { return 'section'; }
}

class PhilterHtmlSelect extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('autofocus'),
            phattrb('disabled'),
            phattrs('form'),
            phattrb('multiple'),
            phattrs('name'),
            phattrb('required'),
            phattri('size'),
        );
    }

    protected function getTag() { return 'select'; }
}

class PhilterHtmlSmall extends PhilterHtml {
    protected function getTag() { return 'small'; }
}

class PhilterHtmlSource extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('src'),
            phattrs('type'),
        );
    }

    protected function getTag() { return 'source'; }
}

class PhilterHtmlSpan extends PhilterHtml {
    protected function getTag() { return 'span'; }
}

class PhilterHtmlStrong extends PhilterHtml {
    protected function getTag() { return 'strong'; }
}

class PhilterHtmlStyle extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('type'),
            phattrs('media'),
            phattrb('scoped'),
            phattrs('title'),
            phattrb('disabled'),
        );
    }

    protected function getTag() { return 'style'; }
}

class PhilterHtmlSub extends PhilterHtml {
    protected function getTag() { return 'sub'; }
}

class PhilterHtmlSummary extends PhilterHtml {
    protected function getTag() { return 'summary'; }
}

class PhilterHtmlSup extends PhilterHtml {
    protected function getTag() { return 'sup'; }
}

class PhilterHtmlTable extends PhilterHtml {
    protected function getTag() { return 'table'; }
}

class PhilterHtmlTbody extends PhilterHtml {
    protected function getTag() { return 'tbody'; }
}

class PhilterHtmlTd extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('colspan'),
            phattrs('headers'),
            phattri('rowspan'),
        );
    }

    protected function getTag() { return 'td'; }
}

class PhilterHtmlTextarea extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('autocomplete'),
            phattrb('autofocus'),
            phattri('cols'),
            phattrb('disabled'),
            phattrs('form'),
            phattri('maxlength'),
            phattri('minlength'),
            phattrs('name'),
            phattrs('placeholder'),
            phattrb('required'),
            phattri('rows'),
            phattrs('wrap'),
        );
    }

    protected function getTag() { return 'textarea'; }
}

class PhilterHtmlTfoot extends PhilterHtml {
    protected function getTag() { return 'tfoot'; }
}

class PhilterHtmlTh extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattri('colspan'),
            phattrs('headers'),
            phattri('rowspan'),
            phattrs('scope'),
        );
    }

    protected function getTag() { return 'th'; }
}

class PhilterHtmlThead extends PhilterHtml {
    protected function getTag() { return 'thead'; }
}

class PhilterHtmlTime extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrs('datetime'),
        );
    }

    protected function getTag() { return 'time'; }
}

class PhilterHtmlTitle extends PhilterHtml {
    protected function getTag() { return 'title'; }
}

class PhilterHtmlTr extends PhilterHtml {
    protected function getTag() { return 'tr'; }
}

class PhilterHtmlTrack extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('default'),
            phattrs('kind'),
            phattrs('label'),
            phattrs('src'),
            phattrs('srclang'),
        );
    }

    protected function getTag() { return 'track'; }
}

class PhilterHtmlU extends PhilterHtml {
    protected function getTag() { return 'u'; }
}

class PhilterHtmlUl extends PhilterHtml {
    protected function getTag() { return 'ul'; }
}

class PhilterHtmlVar extends PhilterHtml {
    protected function getTag() { return 'var'; }
}

class PhilterHtmlVideo extends PhilterHtml {

    protected function getHtmlAttributes() {
        return array(
            phattrb('autoplay'),
            phattrb('controls'),
            phattrs('crossorigin'),
            phattri('height'),
            phattrb('loop'),
            phattrb('muted'),
            phattrs('preload'),
            phattrs('poster'),
            phattrs('src'),
            phattri('width'),
        );
    }

    protected function getTag() { return 'video'; }
}

class PhilterHtmlWbr extends PhilterHtml {
    protected function getTag() { return 'wbr'; }
}