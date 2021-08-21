<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        tinymce.init({
            target: $refs.tinymce,
            themes: 'modern',
            menubar: 'edit format tools',
            menu: {
                edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
                format: { title: 'Format', items: 'bold italic underline strikethrough | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
                tools: { title: 'Tools', items: 'code wordcount' },
            },
            block_formats: 'Default=div; Akapit=p; Nagłowek 1=h1; Nagłowek 2=h2; Nagłowek 3=h3; Nagłowek 4=h4; Nagłowek 5=h5',
            forced_root_block : 'div',
            extended_valid_elements: [
                'ul[class=list-disc list-inside editor-ul]',
                'ol[class=list-decimal list-inside editor-ol]',
                'h1[class=editor-h1]',
                'h2[class=editor-h2]',
                'h3[class=editor-h3]',
                'h4[class=editor-h4]',
                'h5[class=editor-h5]',
                'h6[class=editor-h6]',
                'p[class=editor-p]'
            ],
            language: 'pl',
            plugins: [
                'autoresize autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic underline strikethrough | fontsizeselect lineheight | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist | ' +
                'help',
            toolbar_mode: 'floating',
            style_formats: [
                { title: 'Headings', items: [
                    { title: 'Heading 1', format: 'h1' },
                    { title: 'Heading 2', format: 'h2' },
                    { title: 'Heading 3', format: 'h3' },
                    { title: 'Heading 4', format: 'h4' },
                    { title: 'Heading 5', format: 'h5' },
                    { title: 'Heading 6', format: 'h6' }
                ]},
                { title: 'Inline', items: [
                    { title: 'Bold', format: 'bold' },
                    { title: 'Italic', format: 'italic' },
                    { title: 'Underline', format: 'underline' },
                    { title: 'Strikethrough', format: 'strikethrough' },
                ]},
                { title: 'Blocks', items: [
                    { title: 'Paragraph', format: 'p' },
                    { title: 'Div', format: 'div' },
                ]},
                { title: 'Align', items: [
                    { title: 'Left', format: 'alignleft' },
                    { title: 'Center', format: 'aligncenter' },
                    { title: 'Right', format: 'alignright' },
                    { title: 'Justify', format: 'alignjustify' }
                ]}
            ],
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })

                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })

                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }

                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            }
        })
    "
    wire:ignore
>
    <div>
        <input
            x-ref="tinymce"
            type="textarea"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
</div>
