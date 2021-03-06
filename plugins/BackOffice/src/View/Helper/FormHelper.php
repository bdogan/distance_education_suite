<?php
declare(strict_types=1);

namespace BackOffice\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\FormHelper as BaseFormHelper;

/**
 * Form helper
 */
class FormHelper extends BaseFormHelper
{
    /**
     * Initialize
     *
     * @param array $config
     */
    public function initialize( array $config ): void
    {
        parent::initialize( $config );
        $this->setConfig([
            'errorClass' => 'is-invalid',
            'templates' => [
                'error' => '<div class="invalid-feedback">{{content}}</div>',
                'file' => '<input type="file" name="{{name}}"{{attrs}}>',
                'formGroup' => '{{label}}{{before}}{{prefix}}{{input}}{{suffix}}{{after}}',
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                'inputContainer' => '<div class="{{class}} {{type}}{{required}}">{{content}}{{info}}</div>',
                'inputContainerError' => '<div class="{{class}} {{type}}{{required}}">{{content}}{{error}}</div>'
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function _getInput( $fieldName, $options ) {
        // Set default values
        $options += [
            'class' => '',
            'labelOptions' => []
        ];

        // Determine input class
        switch (strtolower($options['type'])) {
            case 'radio':
            case 'checkbox':
                $options['labelOptions'] = [ 'class' => 'custom-control-label' ];
                $options['class'] = 'custom-control-input ' . $options['class'];
                break;
            case 'file':
                $options['class'] = 'form-control-file ' . $options['class'];
                break;
            default:
                $options['class'] = 'form-control ' . $options['class'];
        }

        // Return parent call
        return parent::_getInput( $fieldName, $options );
    }

    /**
     * @inheritDoc
     */
    protected function _getLabel( $fieldName, $options ) {
        // Set default values
        $options += [
            'label' => null
        ];

        // Determine input class
        switch (strtolower($options['type'])) {
            case 'radio':
            case 'checkbox':
                $options['label'] = [ 'text' => $options['label'], 'class' => 'custom-control-label' ];
                break;
        }

        return parent::_getLabel( $fieldName, $options ); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritDoc
     */
    protected function _inputContainerTemplate( $options ): string
    {
        // Determine container class
        switch (strtolower($options['options']['type'])) {
            case 'radio':
                $options['options']['templateVars'] = [ 'class' => 'form-group custom-control custom-radio' . Hash::get($options, 'options.templateVars.class', '')  ];
                break;
            case 'checkbox':
                $options['options']['templateVars'] = [ 'class' => 'form-group custom-control custom-checkbox ' . Hash::get($options, 'options.templateVars.class', '') ];
                break;
            default:
                $options['options']['templateVars'] = [ 'class' => 'form-group ' . Hash::get($options, 'options.templateVars.class', '') ];
        }

        return parent::_inputContainerTemplate( $options ); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritDoc
     */
    public function control( $fieldName, array $options = [] ): string
    {
        $options += [
            'templateVars' => []
        ];
        $options['templateVars'] += [
            'prefix' => '',
            'suffix' => ''
        ];

        // Input container options
        if (isset($options['container'])) {
            $options['templateVars'] = array_merge($options['templateVars'], $options['container']);
            unset($options['container']);
        }

        // Input prefix
        if (isset($options['prefix'])) {
            $options['templateVars']['before'] = '<div class="input-group">';
            $options['templateVars']['prefix'] = '<div class="input-group-prepend"><span class="input-group-text">' . $options['prefix'] . '</span></div>';
            $options['templateVars']['after'] = '</div>';
            unset($options['prefix']);
        }

        // Input suffix
        if (isset($options['suffix'])) {
            $options['templateVars']['before'] = '<div class="input-group">';
            $options['templateVars']['suffix'] = '<div class="input-group-append"><span class="input-group-text">' . $options['suffix'] . '</span></div>';
            $options['templateVars']['after'] = '</div>';
            unset($options['suffix']);
        }

        // Input info options
        if (isset($options['info'])) {
            $options['templateVars'] = array_merge($options['templateVars'], [ 'info' => $this->Html->tag('small', $options['info'], [ 'id' => $fieldName . '_help', 'class' => 'form-text text-muted' ]) ]);
            unset($options['info']);
        }

        // Render control
        return parent::control( $fieldName, $options );
    }

    /**
     * @param string $fieldName
     * @param array $options
     *
     * @return string
     */
    public function dateTime( $fieldName, array $options = [] ): string
    {
        $options += [
            'monthNames' => false,
            'year' => [ 'class' => 'form-control' ],
            'month' => [ 'class' => 'form-control' ],
            'day' => [ 'class' => 'form-control' ],
            'hour' => [ 'class' => 'form-control' ],
            'minute' => [ 'class' => 'form-control' ],
        ];
        return parent::dateTime( $fieldName, $options );
    }
}
