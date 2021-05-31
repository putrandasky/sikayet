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
  import {
    Editor,
    EditorContent,
    BubbleMenu,
    VueRenderer
  } from '@tiptap/vue-2'
  import tippy from 'tippy.js'
  import StarterKit from '@tiptap/starter-kit'
  import Highlight from '@tiptap/extension-highlight'
  import Placeholder from '@tiptap/extension-placeholder'
  import Mention from '@tiptap/extension-mention'
  import MentionList from './mention/MentionList'
  import {
    Extension
  } from '@tiptap/core'
  import {
    Node,
    mergeAttributes
  } from '@tiptap/core'
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
      const CustomMention = Mention.extend({
        addAttributes() {
          return {
            id: {
              default: null,
              parseHTML: element => {
                return {
                  id: element.getAttribute('data-mention'),
                }
              },
              renderHTML: attributes => {
                console.log(attributes);
                if (!attributes.id.id) {
                  return {}
                }

                return {
                  'data-mention': attributes.id.id,
                }
              },
            },
          }
        },
        renderHTML({
          node,
          HTMLAttributes
        }) {
          return [
            'span',
            mergeAttributes(this.options.HTMLAttributes, HTMLAttributes),
            `${this.options.suggestion.char}${node.attrs.id.name}`,
          ]
        },

        renderText({
          node
        }) {
          return `${this.options.suggestion.char}${node.attrs.id.name}`
        },
        addKeyboardShortcuts() {
          return {
            Backspace: () => this.editor.commands.command(({
              tr,
              state
            }) => {
              let isMention = false
              const {
                selection
              } = state
              const {
                empty,
                anchor
              } = selection

              if (!empty) {
                return false
              }

              state.doc.nodesBetween(anchor - 1, anchor, (node, pos) => {
                if (node.type.name === this.name) {
                  isMention = true
                  tr.insertText(this.options.suggestion.char || '', pos, pos + node.nodeSize)

                  return false
                }
              })
              // console.log(selection);
              console.log(selection.$from.nodeBefore.attrs.id.id);
              return isMention
            }),
          }
        },
      })
      this.editor = new Editor({
        extensions: [
          StarterKit,
          Highlight,
          Placeholder,
          CustomMention.configure({
            HTMLAttributes: {
              class: 'mention',
            },
            suggestion: {
              items: query => {
                return [{
                    name: 'Lea Thompson',
                    id: 1,
                  },
                  {
                    name: 'Andrea',
                    id: 2,
                  },
                ].filter(item => item.name.toLowerCase().startsWith(query.toLowerCase())).slice(0, 5)
              },
              render: () => {
                let component
                let popup

                return {
                  onStart: props => {
                    component = new VueRenderer(MentionList, {
                      parent: this,
                      propsData: props,
                    })

                    popup = tippy('body', {
                      getReferenceClientRect: props.clientRect,
                      appendTo: () => document.body,
                      content: component.element,
                      showOnCreate: true,
                      interactive: true,
                      trigger: 'manual',
                      placement: 'bottom-start',
                    })
                  },
                  onUpdate(props) {
                    component.updateProps(props)

                    popup[0].setProps({
                      getReferenceClientRect: props.clientRect,
                    })
                  },
                  onKeyDown(props) {
                    // return component.ref ? onKeyDown(props) : false;
                  },
                  onExit() {
                    popup[0].destroy()
                    component.destroy()
                  },
                }
              },
            },
          }),
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
