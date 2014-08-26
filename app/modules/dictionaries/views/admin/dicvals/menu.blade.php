<?
    $menus = array();
    $menus[] = array(
        'link' => action('dicval.index', array('dic_id' => $dic->id)),
        'title' => $dic->name,
        'class' => 'btn btn-default'
    );
    if (@is_object($element) && $element->name) {
        $menus[] = array(
            'link' => action('dicval.edit', array('dic_id' => $dic->id, $element->id)),
            'title' => "&laquo;" . $element->name . "&raquo;",
            'class' => 'btn btn-default'
        );
    }
    $menus[] = array(
        'link' => action('dicval.create', array('dic_id' => $dic->id)),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
    );
    if (Allow::action($module['group'], 'edit')) {
        $menus[] = array(
            'link' => action('dic.edit', array('dic_id' => $dic->id)),
            'title' => 'Изменить',
            'class' => 'btn btn-success'
        );
    }
?>
    
    <h1>{{ $dic->name }}</h1>

    {{ Helper::drawmenu($menus) }}
