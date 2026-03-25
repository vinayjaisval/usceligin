/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/**/*.jsx",
    "./resources/**/*.ts",
    "./resources/**/*.tsx",
    "./app/**/*.php",
    "./assets/**/*.js",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      // Font family
      fontFamily: {
        'sans': ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      // CSS Variables mapped to Tailwind
      colors: {
        // Primary Blue System (Brand Colors)
        primary: {
          900: '#1A2D5C', // AAA Text (18.1:1) - CTAs, important text
          800: '#2E4682', // AAA Text (7.0:1) - Body text, headings
          700: '#3D5BA9', // AA Text (4.5:1) - Links, interactive text
          600: '#5C80E0', // Accent Only (3.0:1) - Backgrounds, borders, icons
          500: '#7A9AE8', // Large Text only (2.3:1)
          400: '#98B3F0', // Background only
          300: '#B6CCF7', // Background only
          200: '#D4E5FB', // Background only
          100: '#EAF2FE', // Background only
          50:  '#F5F8FF', // Ultra-light tint — ghost/outline button hover
        },

        // Neutral Gray System
        neutral: {
          900: '#0F172A', // AAA Text - Main headings
          800: '#1E293B', // AAA Text
          700: '#334155', // AAA Text
          500: '#64748B', // AA Text
          200: '#E2E8F0', // Background
          50: '#F8FAFC',  // Background
        },

        // Semantic Colors
        semantic: {
          success: '#059669', // AA Text (4.5:1)
          warning: '#D97706', // AA Text (4.6:1)
          error: '#DC2626',   // AA Text (4.5:1)
          info: '#0284C7',    // AA Text (4.5:1)
        },

        // Background colors (CSS Variables for theme support)
        'bg-primary': 'var(--bg-primary)',
        'bg-secondary': 'var(--bg-secondary)',
        'bg-tertiary': 'var(--bg-tertiary)',
        'bg-quaternary': 'var(--bg-quaternary)',

        // Text colors
        'text-primary': 'var(--text-primary)',
        'text-secondary': 'var(--text-secondary)',
        'text-tertiary': 'var(--text-tertiary)',

        // Accent colors (mapped to new primary)
        'accent-primary': 'var(--accent-primary)',
        'accent-secondary': 'var(--accent-secondary)',
        'accent-tertiary': 'var(--accent-tertiary)',
        'accent-dark': 'var(--accent-dark)',

        // Brand colors
        'brand-warm': 'var(--brand-warm)',
        'brand-sage': 'var(--brand-sage)',
        'brand-cream': 'var(--brand-cream)',

        // Border colors
        'border-light': 'var(--border-light)',
        'border-medium': 'var(--border-medium)',

        // Status colors (CSS Variables)
        'success': 'var(--success)',
        'warning': 'var(--warning)',
        'danger': 'var(--danger)',

        // Base colors
        'grey-light': 'var(--grey-light)',
        'grey-medium': 'var(--grey-medium)',
        'white': 'var(--white)',
        'black': 'var(--black)',

        // Alert system colors
        'info-bg': 'var(--info-bg)',
        'info-border': 'var(--info-border)',
        'info-text': 'var(--info-text)',
        'info-icon': 'var(--info-icon)',
        'success-bg': 'var(--success-bg)',
        'success-border': 'var(--success-border)',
        'success-text': 'var(--success-text)',
        'success-icon': 'var(--success-icon)',
        'error-bg': 'var(--error-bg)',
        'error-border': 'var(--error-border)',
        'error-text': 'var(--error-text)',
        'error-icon': 'var(--error-icon)',
        'warning-bg': 'var(--warning-bg)',
        'warning-border': 'var(--warning-border)',
        'warning-text': 'var(--warning-text)',
        'warning-icon': 'var(--warning-icon)',
      },

      // Spacing system
      spacing: {
        'xs': 'var(--spacing-xs)',
        'sm': 'var(--spacing-sm)',
        'md': 'var(--spacing-md)',
        'lg': 'var(--spacing-lg)',
        'xl': 'var(--spacing-xl)',
        '2xl': 'var(--spacing-2xl)',
        '3xl': 'var(--spacing-3xl)',
      },

      // Font sizes
      fontSize: {
        'xs': 'var(--font-size-xs)',
        'sm': 'var(--font-size-sm)',
        'base': 'var(--font-size-base)',
        'md': 'var(--font-size-md)',
        'lg': 'var(--font-size-lg)',
        'xl': 'var(--font-size-xl)',
        '2xl': 'var(--font-size-2xl)',
        '3xl': 'var(--font-size-3xl)',
        '4xl': 'var(--font-size-4xl)',
        '5xl': 'var(--font-size-5xl)',
      },

      // Font weights
      fontWeight: {
        'light': 'var(--font-weight-light)',
        'normal': 'var(--font-weight-normal)',
        'medium': 'var(--font-weight-medium)',
        'semibold': 'var(--font-weight-semibold)',
        'bold': 'var(--font-weight-bold)',
      },

      // Line heights
      lineHeight: {
        'tight': 'var(--line-height-tight)',
        'normal': 'var(--line-height-normal)',
        'relaxed': 'var(--line-height-relaxed)',
        'loose': 'var(--line-height-loose)',
      },

      // Container max widths
      maxWidth: {
        'container-sm': 'var(--container-sm)',
        'container-md': 'var(--container-md)',
        'container-lg': 'var(--container-lg)',
        'container-xl': 'var(--container-xl)',
        'container-2xl': 'var(--container-2xl)',
      },

      // Box shadows
      boxShadow: {
        'light': 'var(--shadow-light)',
        'medium': 'var(--shadow-medium)',
        'heavy': 'var(--shadow-heavy)',
      },

      // Transitions
      transitionDuration: {
        'fast': '0.15s',
        'medium': '0.3s',
        'slow': '0.5s',
      },

      // Border radius - keeping none as default for sharp design
      borderRadius: {
        'none': '0',
        'DEFAULT': '0',
      },
    },
  },
  plugins: [],
}