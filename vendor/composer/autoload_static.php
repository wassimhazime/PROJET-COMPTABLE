<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d17eee377304cd3997e65e87a91b166
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'S' => 
        array (
            'Slim\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/app',
        ),
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Nette\\ArgumentOutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Bridges\\FormsDI\\FormsExtension' => __DIR__ . '/..' . '/nette/forms/src/Bridges/FormsDI/FormsExtension.php',
        'Nette\\Bridges\\FormsLatte\\FormMacros' => __DIR__ . '/..' . '/nette/forms/src/Bridges/FormsLatte/FormMacros.php',
        'Nette\\Bridges\\FormsLatte\\Runtime' => __DIR__ . '/..' . '/nette/forms/src/Bridges/FormsLatte/Runtime.php',
        'Nette\\Bridges\\HttpDI\\HttpExtension' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpDI/HttpExtension.php',
        'Nette\\Bridges\\HttpDI\\SessionExtension' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpDI/SessionExtension.php',
        'Nette\\Bridges\\HttpTracy\\SessionPanel' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpTracy/SessionPanel.php',
        'Nette\\ComponentModel\\Component' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/Component.php',
        'Nette\\ComponentModel\\Container' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/Container.php',
        'Nette\\ComponentModel\\IComponent' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/IComponent.php',
        'Nette\\ComponentModel\\IContainer' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/IContainer.php',
        'Nette\\ComponentModel\\RecursiveComponentIterator' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/RecursiveComponentIterator.php',
        'Nette\\DeprecatedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\DirectoryNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\FileNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Forms\\Container' => __DIR__ . '/..' . '/nette/forms/src/Forms/Container.php',
        'Nette\\Forms\\ControlGroup' => __DIR__ . '/..' . '/nette/forms/src/Forms/ControlGroup.php',
        'Nette\\Forms\\Controls\\BaseControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/BaseControl.php',
        'Nette\\Forms\\Controls\\Button' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/Button.php',
        'Nette\\Forms\\Controls\\Checkbox' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/Checkbox.php',
        'Nette\\Forms\\Controls\\CheckboxList' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/CheckboxList.php',
        'Nette\\Forms\\Controls\\ChoiceControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/ChoiceControl.php',
        'Nette\\Forms\\Controls\\CsrfProtection' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/CsrfProtection.php',
        'Nette\\Forms\\Controls\\HiddenField' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/HiddenField.php',
        'Nette\\Forms\\Controls\\ImageButton' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/ImageButton.php',
        'Nette\\Forms\\Controls\\MultiChoiceControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/MultiChoiceControl.php',
        'Nette\\Forms\\Controls\\MultiSelectBox' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/MultiSelectBox.php',
        'Nette\\Forms\\Controls\\RadioList' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/RadioList.php',
        'Nette\\Forms\\Controls\\SelectBox' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/SelectBox.php',
        'Nette\\Forms\\Controls\\SubmitButton' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/SubmitButton.php',
        'Nette\\Forms\\Controls\\TextArea' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/TextArea.php',
        'Nette\\Forms\\Controls\\TextBase' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/TextBase.php',
        'Nette\\Forms\\Controls\\TextInput' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/TextInput.php',
        'Nette\\Forms\\Controls\\UploadControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/Controls/UploadControl.php',
        'Nette\\Forms\\Form' => __DIR__ . '/..' . '/nette/forms/src/Forms/Form.php',
        'Nette\\Forms\\Helpers' => __DIR__ . '/..' . '/nette/forms/src/Forms/Helpers.php',
        'Nette\\Forms\\IControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/IControl.php',
        'Nette\\Forms\\IFormRenderer' => __DIR__ . '/..' . '/nette/forms/src/Forms/IFormRenderer.php',
        'Nette\\Forms\\ISubmitterControl' => __DIR__ . '/..' . '/nette/forms/src/Forms/ISubmitterControl.php',
        'Nette\\Forms\\Rendering\\DefaultFormRenderer' => __DIR__ . '/..' . '/nette/forms/src/Forms/Rendering/DefaultFormRenderer.php',
        'Nette\\Forms\\Rule' => __DIR__ . '/..' . '/nette/forms/src/Forms/Rule.php',
        'Nette\\Forms\\Rules' => __DIR__ . '/..' . '/nette/forms/src/Forms/Rules.php',
        'Nette\\Forms\\Validator' => __DIR__ . '/..' . '/nette/forms/src/Forms/Validator.php',
        'Nette\\Http\\Context' => __DIR__ . '/..' . '/nette/http/src/Http/Context.php',
        'Nette\\Http\\FileUpload' => __DIR__ . '/..' . '/nette/http/src/Http/FileUpload.php',
        'Nette\\Http\\Helpers' => __DIR__ . '/..' . '/nette/http/src/Http/Helpers.php',
        'Nette\\Http\\IRequest' => __DIR__ . '/..' . '/nette/http/src/Http/IRequest.php',
        'Nette\\Http\\IResponse' => __DIR__ . '/..' . '/nette/http/src/Http/IResponse.php',
        'Nette\\Http\\ISessionStorage' => __DIR__ . '/..' . '/nette/http/src/Http/ISessionStorage.php',
        'Nette\\Http\\Request' => __DIR__ . '/..' . '/nette/http/src/Http/Request.php',
        'Nette\\Http\\RequestFactory' => __DIR__ . '/..' . '/nette/http/src/Http/RequestFactory.php',
        'Nette\\Http\\Response' => __DIR__ . '/..' . '/nette/http/src/Http/Response.php',
        'Nette\\Http\\Session' => __DIR__ . '/..' . '/nette/http/src/Http/Session.php',
        'Nette\\Http\\SessionSection' => __DIR__ . '/..' . '/nette/http/src/Http/SessionSection.php',
        'Nette\\Http\\Url' => __DIR__ . '/..' . '/nette/http/src/Http/Url.php',
        'Nette\\Http\\UrlScript' => __DIR__ . '/..' . '/nette/http/src/Http/UrlScript.php',
        'Nette\\Http\\UserStorage' => __DIR__ . '/..' . '/nette/http/src/Http/UserStorage.php',
        'Nette\\IOException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\InvalidArgumentException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\InvalidStateException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Iterators\\CachingIterator' => __DIR__ . '/..' . '/nette/utils/src/Iterators/CachingIterator.php',
        'Nette\\Iterators\\Filter' => __DIR__ . '/..' . '/nette/utils/src/Iterators/Filter.php',
        'Nette\\Iterators\\Mapper' => __DIR__ . '/..' . '/nette/utils/src/Iterators/Mapper.php',
        'Nette\\Iterators\\RecursiveFilter' => __DIR__ . '/..' . '/nette/utils/src/Iterators/RecursiveFilter.php',
        'Nette\\Localization\\ITranslator' => __DIR__ . '/..' . '/nette/utils/src/Utils/ITranslator.php',
        'Nette\\MemberAccessException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\NotImplementedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\NotSupportedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Object' => __DIR__ . '/..' . '/nette/utils/src/Utils/Object.php',
        'Nette\\OutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\SmartObject' => __DIR__ . '/..' . '/nette/utils/src/Utils/SmartObject.php',
        'Nette\\StaticClass' => __DIR__ . '/..' . '/nette/utils/src/Utils/StaticClass.php',
        'Nette\\StaticClassException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\UnexpectedValueException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\ArrayHash' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayHash.php',
        'Nette\\Utils\\ArrayList' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayList.php',
        'Nette\\Utils\\Arrays' => __DIR__ . '/..' . '/nette/utils/src/Utils/Arrays.php',
        'Nette\\Utils\\AssertionException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Callback' => __DIR__ . '/..' . '/nette/utils/src/Utils/Callback.php',
        'Nette\\Utils\\DateTime' => __DIR__ . '/..' . '/nette/utils/src/Utils/DateTime.php',
        'Nette\\Utils\\FileSystem' => __DIR__ . '/..' . '/nette/utils/src/Utils/FileSystem.php',
        'Nette\\Utils\\Html' => __DIR__ . '/..' . '/nette/utils/src/Utils/Html.php',
        'Nette\\Utils\\IHtmlString' => __DIR__ . '/..' . '/nette/utils/src/Utils/IHtmlString.php',
        'Nette\\Utils\\Image' => __DIR__ . '/..' . '/nette/utils/src/Utils/Image.php',
        'Nette\\Utils\\ImageException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Json' => __DIR__ . '/..' . '/nette/utils/src/Utils/Json.php',
        'Nette\\Utils\\JsonException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\ObjectMixin' => __DIR__ . '/..' . '/nette/utils/src/Utils/ObjectMixin.php',
        'Nette\\Utils\\Paginator' => __DIR__ . '/..' . '/nette/utils/src/Utils/Paginator.php',
        'Nette\\Utils\\Random' => __DIR__ . '/..' . '/nette/utils/src/Utils/Random.php',
        'Nette\\Utils\\Reflection' => __DIR__ . '/..' . '/nette/utils/src/Utils/Reflection.php',
        'Nette\\Utils\\RegexpException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Strings' => __DIR__ . '/..' . '/nette/utils/src/Utils/Strings.php',
        'Nette\\Utils\\UnknownImageFileException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Validators' => __DIR__ . '/..' . '/nette/utils/src/Utils/Validators.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d17eee377304cd3997e65e87a91b166::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d17eee377304cd3997e65e87a91b166::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit1d17eee377304cd3997e65e87a91b166::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit1d17eee377304cd3997e65e87a91b166::$classMap;

        }, null, ClassLoader::class);
    }
}
