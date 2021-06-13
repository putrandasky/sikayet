<template>
  <div>
    <bubble-menu class="bubble-menu" :tippy-options="{ duration: 100 }" :editor="editor" v-if="editor">
      <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
        Bold
      </button>
      <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
        Italic
      </button>
      <button @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
        Strike
      </button>
      <button @click="editor.chain().focus().toggleHighlight().run()" :class="{ 'is-active': editor.isActive('highlight', { color: 'red' }) }">
        Highlight
      </button>
    </bubble-menu>
    <editor-content data-placeholder="sesuatu" :editor="editor" />
  </div>
</template>

<script>
  import debounce from '../utils/debounce'

  import {
    Editor,
    EditorContent,
    BubbleMenu,
    VueRenderer,
    Node
  } from '@tiptap/vue-2'
  // import tippy from 'tippy.js'
  import StarterKit from '@tiptap/starter-kit'
  import Highlight from '@tiptap/extension-highlight'
  import Placeholder from '@tiptap/extension-placeholder'

  // import {
  //   Extension
  // } from '@tiptap/core'
  // import {
  //   Node,
  //   mergeAttributes
  // } from '@tiptap/core'
  export default {
    props: {
      value: {
        type: String,
        default: '',
      },
    },
    components: {
      EditorContent,
      BubbleMenu,
    },

    data() {
      return {
        editor: null,
      }
    },

    mounted() {
      let self = this
      const customParagraph = Node.extend({
        name() {
          return 'paragraph';
        },
        schema() {
          return {
            content: 'inline*',
            draggable: false,
            group: 'block',
            parseDOM: [{
              tag: 'div',
            }],
            toDOM() {
              return ['div', 0];
            },
          };
        }
      })
      this.editor = new Editor({
        useBuiltInExtensions: false,
        extensions: [
          StarterKit,
          Highlight,
          Placeholder,
          customParagraph
        ],
        content: this.value,
        onFocus({
          event
        }) {
          self.$emit('focus', event)

        },
        onBlur({
          event
        }) {
          self.$emit('blur', event)

        },
        // tell ProseMirror to ignore drop event
        editorProps: {
          handleDOMEvents: {
            drop: (view, e) => {
              e.preventDefault();
            },
          }
        },
        // hide the drop position indicator
        dropCursor: {
          width: 0,
          color: 'transparent'
        },
        onUpdate: debounce(function() {
          // HTML

          self.$emit('input', self.editor.getHTML())

          // JSON
          // this.$emit('input', this.editor.getJSON())
        }, 500)
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
  }
</script>
<style lang="scss">
  .ProseMirror {
    // >*+* {
    //     margin-top: 0.75em;
    // }



    ul,
    ol {
      padding: 0 1rem;
    }

    blockquote {
      padding-left: 1rem;
      border-left: 2px solid rgba(#0D0D0D, 0.1);
    }

    mark {
      background-color: #ffe066 !important;
    }
  }

  .bubble-menu {
    display: flex;
    background-color: #0D0D0D;
    padding: 0.2rem;
    border-radius: 0.5rem;

    button {
      border: none;
      background: none;
      color: #FFF;
      font-size: 0.85rem;
      font-weight: 500;
      padding: 0 0.2rem;
      opacity: 0.6;

      &:hover,
      &.is-active {
        opacity: 1;
      }
    }
  }

  .mention {
    color: #A975FF;
    background-color: rgba(#A975FF, 0.1);
    border-radius: 0.3rem;
    padding: 0.1rem 0.3rem;
  }

  .floating-menu {
    display: flex;
    background-color: #0D0D0D10;
    padding: 0.2rem;
    border-radius: 0.5rem;

    button {
      border: none;
      background: none;
      font-size: 0.85rem;
      font-weight: 500;
      padding: 0 0.2rem;
      opacity: 0.6;

      &:hover,
      &.is-active {
        opacity: 1;
      }
    }
  }
</style>
