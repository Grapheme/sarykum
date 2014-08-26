
<?
#Helper::tad($element->metas->where('language', $locale_sign)->first());
#Helper::ta($element);
$element_meta = new DicValMeta;
if (@is_object($element->metas) && $element->metas->count())
    foreach ($element->metas as $tmp) {
        #Helper::ta($tmp);
        if ($tmp->language == $locale_sign) {
            $element_meta = $tmp;
            break;
        }
    }
?>

@if (count($locales) > 1)
    <section>
        <label class="label">Название</label>
        <label class="input select input-select2">
            {{ Form::text('locales[' . $locale_sign . '][name]', $element_meta->name, array()) }}
        </label>
    </section>
@endif

@if (count($locales) > 1)

    @if (@count($fields['i18n']))
    <?
    $element_fields = array();
    if (@is_object($element->fields)) {
        $element_fields = $element->fields;
        foreach ($element_fields as $f => $field) {
            if (!$field->language)
                unset($element_fields[$f]);
        }
        #$element_fields = $element_fields->lists('value', 'key');
        #Helper::ta($element_fields);
    }
    ?>
        @foreach ($fields['i18n'] as $field)
<?
$field_meta = new DicFieldVal();
foreach ($element_fields as $tmp) {
    #Helper::ta($tmp);
    if ($tmp->key == @$field['name'] && $tmp->language == $locale_sign) {
        $field_meta = $tmp;
        #Helper::ta($field_meta);
        break;
    }
}
?>
        <section>
            <label class="label">{{ $field['title'] }}</label>
            <label class="input {{ $field['type'] }}">
                {{ Helper::formField($field, 'fields_i18n[' . $locale_sign . ']', @$field_meta->value) }}
            </label>
        </section>
        @endforeach
    @endif

@endif