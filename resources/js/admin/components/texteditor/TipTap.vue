<template>
  <div class="editor" v-if="editor">
    <menu-bar class="editor__header" :editor="editor" />
    <editor-content class="editor__content" :editor="editor" />
  </div>
</template>
<script>
  import {
    Editor,
    EditorContent
  } from '@tiptap/vue-2'
  import StarterKit from '@tiptap/starter-kit'
  import TaskList from '@tiptap/extension-task-list'
  import TaskItem from '@tiptap/extension-task-item'
  import Highlight from '@tiptap/extension-highlight'
  import Image from '@tiptap/extension-image'
  import TextAlign from '@tiptap/extension-text-align'
  import MenuBar from './MenuBar.vue'
  export default {
    props: {
      value: {
        type: String,
        default: '',
      },
    },
    name: 'TipTap',
    components: {
      EditorContent,
      MenuBar,
    },
    data: function() {
      return {
        editor: null,
      }
    },
    mounted() {
      this.editor = new Editor({
        extensions: [
          StarterKit,
          Highlight,
          TaskList,
          TaskItem,
          Image,
          TextAlign
        ],
        content: this.value,
        onFocus({
          event
        }) {

        },
        onBlur({
          event
        }) {

        },
        onUpdate: () => {
          // HTML

          this.$emit('input', this.editor.getHTML())

          // JSON
          // this.$emit('input', this.editor.getJSON())
        },
      })
    },
    beforeDestroy() {
      this.editor.destroy()
    },
    watch: {
      value(value) {
        // HTML
        const isSame = this.editor.getHTML() === value

        // JSON
        // const isSame = this.editor.getJSON().toString() === value.toString()

        if (isSame) {
          return
        }

        this.editor.commands.setContent(this.value, false)
      },
    },
    methods: {

    },
  }
</script>
<style lang="scss" scoped>
  .editor {
    display: flex;
    flex-direction: column;
    max-height: 400px;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;

    &__header {
      display: flex;
      align-items: center;
      flex: 0 0 auto;
      flex-wrap: wrap;
      padding: 0.25rem;
      border-bottom: 1px solid #ced4da;
    }

    &__content {
      padding: 1.25rem 1rem;
      flex: 1 1 auto;
      overflow-x: hidden;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
    }
  }
</style>
<style lang="scss">
  /* Basic editor styles */
  .ProseMirror {
    >*+* {
      margin-top: 0.75em;
    }

    ul,
    ol {
      padding: 0 1rem;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      line-height: 1.1;
    }

    code {
      background-color: rgba(#616161, 0.1);
      color: #616161;
    }

    pre {
      background: #0D0D0D;
      color: #FFF;
      font-family: 'JetBrainsMono', monospace;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;

      code {
        color: inherit;
        padding: 0;
        background: none;
        font-size: 0.8rem;
      }
    }

    mark {
      background-color: #FAF594;
    }

    img {
      max-width: 100%;
      height: auto;
    }

    hr {
      margin: 1rem 0;
    }

    blockquote {
      padding-left: 1rem;
      border-left: 2px solid rgba(#0D0D0D, 0.1);
    }

    hr {
      border: none;
      border-top: 2px solid rgba(#0D0D0D, 0.1);
      margin: 2rem 0;
    }

    ul[data-type="taskList"] {
      list-style: none;
      padding: 0;

      li {
        display: flex;
        align-items: center;

        >label {
          flex: 0 0 auto;
          margin-right: 0.5rem;
        }
      }
    }
  }
</style>
