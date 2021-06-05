<?php

class Field {
    function __construct( $label, $name, $id ) {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
    }

    public function slugify( $text ) {
        $text = preg_replace( '~[^\pL\d]+~u', '-', $text );
        $text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );
        $text = preg_replace( '~[^-\w]+~', '', $text );
        $text = trim( $text, '-' );
        $text = preg_replace( '~-+~', '-', $text );
        $text = strtolower( $text );

        if ( empty( $text ) ) {
            return 'n-a';
        }

        return $text;
    }
}

class Select extends Field {
    private $options = [];

    function __construct( $label, $name = '', $id = '' ) {
        $name = empty( $name ) ? $this->slugify( $label ) : $name;
        $id = empty( $id ) ? $name : $id;

        parent::__construct( $label, $name, $id );
    }

    public function add_option( $text, $value = '' ) {
        if ( empty( $value ) ) {
            $value = $text;
        }

        $this->options[] = [$text, $value];
    }

    public function render() {
        $label = "<label for='{$this->id}' class='form-label'>{$this->label}</label>";
        $options = '<option value="">Selecione...</option>';
        foreach ( $this->options as $option ) {
            $options .= "<option value=" . htmlspecialchars( $option[1] ) . ">" . htmlspecialchars( $option[0] ) . "</option>";
        }

        echo sprintf( "%s<select class='form-select' name='{$this->name}' id='{$this->id}'>%s</select>", $label, $options );
    }
}