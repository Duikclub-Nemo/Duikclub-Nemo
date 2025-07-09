/*
* This file is part of the Duikclub Nemo website.
* Copyright (C) 2025 Duikclub Nemo.
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
*/

<script setup>
import {computed} from 'vue';
import {usePage} from "@inertiajs/vue3";
import {Ckeditor, useCKEditorCloud} from '@ckeditor/ckeditor5-vue';

const props = defineProps({
    ckeditorLicenseKey: String,
    path: {
        type: String,
        default: null
    }
})

const model = defineModel({
    required: true,
});

const cloud = useCKEditorCloud({
    version: '44.3.0',
    translations: ['nl']
});

const editor = computed(() => {
    if (!cloud.data.value) {
        return null;
    }

    return cloud.data.value.CKEditor.ClassicEditor;
});

const config = computed(() => {
    if (!cloud.data.value) {
        return null;
    }

    const {
        Alignment,
        AutoImage,
        AutoLink,
        BlockQuote,
        Bold,
        Bookmark,
        Essentials,
        Emoji,
        FontBackgroundColor,
        FontColor,
        FontSize,
        Heading,
        HorizontalLine,
        Image,
        ImageInsert,
        ImageInsertViaUrl,
        ImageResize,
        ImageResizeEditing,
        ImageResizeHandles,
        ImageStyle,
        ImageToolbar,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        MediaEmbed,
        Mention,
        Paragraph,
        RemoveFormat,
        ShowBlocks,
        SimpleUploadAdapter,
        SourceEditing,
        SpecialCharacters,
        SpecialCharactersEssentials,
        Strikethrough,
        Subscript,
        Superscript,
        Table,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        Underline,
        Undo
    } = cloud.data.value.CKEditor;

    return {
        licenseKey: props.ckeditorLicenseKey,
        plugins: [
            Alignment,
            AutoImage,
            AutoLink,
            BlockQuote,
            Bold,
            Bookmark,
            Emoji,
            Essentials,
            FontBackgroundColor,
            FontColor,
            FontSize,
            Heading,
            HorizontalLine,
            Image,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageResizeEditing,
            ImageResizeHandles,
            ImageStyle,
            ImageToolbar,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            ListProperties,
            MediaEmbed,
            Mention,
            Paragraph,
            RemoveFormat,
            ShowBlocks,
            SimpleUploadAdapter,
            SourceEditing,
            SpecialCharacters,
            SpecialCharactersEssentials,
            Strikethrough,
            Subscript,
            Superscript,
            Table,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            Underline,
            Undo
        ],
        toolbar: {
            items: [
                'undo',
                'redo',
                '|',
                'heading',
                'bold',
                'italic',
                'underline',
                {
                    label: 'Meer opties',
                    icon: 'threeVerticalDots',
                    items: ['strikethrough', 'superscript', 'subscript']
                },
                'fontSize',
                'fontColor',
                'fontBackgroundColor',
                'removeFormat',
                '|',
                'alignment',
                '|',
                'link',
                'bookmark',
                'insertImage',
                'insertTable',
                'mediaEmbed',
                'blockquote',
                'specialCharacters',
                'emoji',
                'horizontalLine',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'outdent',
                'indent',
                '|',
                'showBlocks',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        simpleUpload: {
            uploadUrl: route('ck_upload', props.path),
            headers: {
                'X-CSRF-TOKEN': usePage().props.csrf_token
            }
        },
        image: {
            toolbar: [
                {
                    name: 'imageStyle:alignment',
                    title: 'Uitlijnen',
                    items: [
                        'imageStyle:alignBlockLeft',
                        'imageStyle:alignCenter',
                        'imageStyle:alignBlockRight'
                    ],
                    defaultItem: 'imageStyle:alignBlockLeft'
                },
                {
                    name: 'imageStyle:inline',
                    title: 'Inlijn uitlijnen',
                    items: [
                        'imageStyle:alignLeft',
                        'imageStyle:alignRight'
                    ],
                    defaultItem: 'imageStyle:alignRight'
                },
                '|',
                'imageTextAlternative',
                '|',
                'linkImage'
            ],
            insert: {
                type: 'auto',
                integrations: ['upload', 'url']
            }
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        link: {
            decorators: {
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in a new tab',
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                }
            }
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
        },
        heading: {
            options: [
                {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'}
            ]
        }
    };
});
</script>

<template>
    <ckeditor v-if="editor"
              v-model="model"
              :editor="editor"
              :config="config"/>
</template>

<style>
.ck-editor__editable,
.ck-source-editing-area {
    min-height: 500px;
    width: 100% !important;
}

.ck-sticky-panel__content_sticky {
    z-index: 50 !important;
    top: 56px !important;
}
</style>
