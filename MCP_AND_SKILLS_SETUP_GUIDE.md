# MCP Servers & Skills Setup Guide

Complete reference for installing MCP servers and skills in new projects.

**Last Updated:** 2025-12-22

---

## 📋 Table of Contents

1. [MCP Servers Overview](#mcp-servers-overview)
2. [User-Level MCP Installation](#user-level-mcp-installation)
3. [Project-Level MCP Installation](#project-level-mcp-installation)
4. [Skills Overview](#skills-overview)
5. [User-Level Skills Installation](#user-level-skills-installation)
6. [Project-Level Skills Installation](#project-level-skills-installation)
7. [Quick Setup Commands](#quick-setup-commands)

---

## 🔧 MCP Servers Overview

### What Are MCP Servers?

MCP (Model Context Protocol) servers extend Claude Code with additional capabilities like web search, browser automation, design tools, etc.

### Two Installation Levels

| Level | Location | Available In | Shared with Team |
|-------|----------|--------------|------------------|
| **User-Level** | `~/.claude.json` | ALL your projects | ❌ No (personal) |
| **Project-Level** | `.mcp.json` | Only THIS project | ✅ Yes (via git) |

---

## 🌐 User-Level MCP Installation

**Location:** `C:\Users\<username>\.claude.json` (Windows) or `~/.claude.json` (Mac/Linux)

**Purpose:** Tools you want available in EVERY project you work on.

### 1. Context7 - Semantic Memory

**What it does:** Remembers context across sessions, provides smart suggestions.

```bash
claude mcp add --transport http context7 --scope user \
  https://mcp.context7.com/mcp \
  --header "CONTEXT7_API_KEY: YOUR_API_KEY"
```

**Get API Key:** https://context7.com/

---

### 2. DuckDuckGo Search

**What it does:** Web search without leaving Claude Code.

```bash
npm install -g duckduckgo-mcp-server

claude mcp add --transport stdio duckduckgo --scope user \
  -- duckduckgo-mcp-server
```

---

### 3. Sequential Thinking

**What it does:** Complex problem breakdown and step-by-step reasoning.

```bash
claude mcp add --transport stdio sequentialthinking --scope user \
  -- npx -y @modelcontextprotocol/server-sequential-thinking
```

---

### 4. Playwright - Browser Automation

**What it does:** E2E testing, screenshots, browser automation.

```bash
# Install Playwright globally (optional, npx will download if needed)
npm install -g playwright

# Add to Claude Code
claude mcp add --transport stdio playwright --scope user \
  -- npx -y playwright-mcp

# Install browser binaries (required)
npx playwright install chromium
```

---

### 5. Figma - Design Integration

**What it does:** Access Figma designs, extract design tokens, design-to-code workflows.

```bash
claude mcp add --transport http figma --scope user \
  https://mcp.figma.com/mcp
```

**Authentication:** First time in Claude Code:
1. Type `/mcp`
2. Select `figma`
3. Click `Authenticate`
4. Allow access in browser

---

### ✅ Verify User-Level Installation

```bash
# List all MCP servers
claude mcp list

# Expected output:
# duckduckgo: ✓ Connected
# sequentialthinking: ✓ Connected
# context7: ✓ Connected
# playwright: ✓ Connected
# figma: ✓ Connected
```

---

## 📦 Project-Level MCP Installation

**Location:** `.mcp.json` in project root

**Purpose:** Tools specific to THIS project that the whole team needs.

### 1. GitHub MCP (Team Collaboration)

**What it does:** Create issues, manage PRs, review code, check CI/CD status.

```bash
# Navigate to your project directory
cd /path/to/your/project

# Add GitHub MCP
claude mcp add --transport http github --scope project \
  https://api.githubcopilot.com/mcp/
```

**Authentication:** Handled automatically by Claude Code OAuth.

---

### Example: Project `.mcp.json`

After installation, your `.mcp.json` should look like:

```json
{
  "mcpServers": {
    "github": {
      "type": "http",
      "url": "https://api.githubcopilot.com/mcp/"
    }
  }
}
```

**Commit this file to git** so your team gets it automatically!

---

## 🎨 Skills Overview

### What Are Skills?

Skills are guidelines and patterns that Claude Code follows when writing code.

### Two Installation Levels

| Level | Location | Available In | Shared with Team |
|-------|----------|--------------|------------------|
| **User-Level** | `~/.claude/skills/` | ALL your projects | ❌ No (personal) |
| **Project-Level** | `.claude/skills/` | Only THIS project | ✅ Yes (via git) |

---

## 🌟 User-Level Skills Installation

**Location:** `C:\Users\<username>\.claude\skills\` (Windows) or `~/.claude/skills/` (Mac/Linux)

**Purpose:** Universal coding standards that apply to ALL your projects.

### 1. User Experience Skill

**What it enforces:** Clean design, responsive behavior, dark mode support.

```bash
# Create directory
mkdir -p ~/.claude/skills/user-experience

# Download or copy SKILL.md
# (See attached user-experience/SKILL.md)
```

**SKILL.md location:** `~/.claude/skills/user-experience/SKILL.md`

**Key features:**
- Clean & simple design principles
- Mobile-first responsive design
- Light and dark mode support
- Design file adherence (Figma/Sketch)
- Touch-friendly interfaces

---

### 2. Accessibility Skill

**What it enforces:** WCAG 2.0/2.1/2.2 compliance (A, AA, AAA levels).

```bash
# Create directory
mkdir -p ~/.claude/skills/accessibility

# Download or copy SKILL.md
# (See attached accessibility/SKILL.md)
```

**SKILL.md location:** `~/.claude/skills/accessibility/SKILL.md`

**Key features:**
- WCAG compliance standards
- Semantic HTML
- ARIA attributes
- Keyboard navigation
- Screen reader support
- Color contrast requirements

---

### 3. UI Development Skill

**What it enforces:** Clean code, DRY principles, HTML/CSS/JS best practices.

```bash
# Create directory
mkdir -p ~/.claude/skills/ui-development

# Download or copy SKILL.md
# (See attached ui-development/SKILL.md)
```

**SKILL.md location:** `~/.claude/skills/ui-development/SKILL.md`

**Key features:**
- Clean code principles
- DRY (Don't Repeat Yourself)
- Semantic HTML
- Responsive CSS
- Vanilla JavaScript patterns
- SEO optimization

---

### ✅ Verify User-Level Skills

```bash
# List user-level skills
ls -la ~/.claude/skills/

# Expected output:
# accessibility/
# ui-development/
# user-experience/
```

---

## 🏗️ Project-Level Skills Installation

**Location:** `.claude/skills/` in project root

**Purpose:** Framework/technology-specific patterns for THIS project.

### Example: Laravel Patterns Skill

```bash
# Navigate to your Laravel project
cd /path/to/laravel/project

# Create skills directory
mkdir -p .claude/skills/laravel-patterns

# Copy SKILL.md and REFERENCE.md
# (These files are project-specific)
```

**Commit to git** so your team gets the same standards!

### Structure:
```
.claude/skills/laravel-patterns/
├── SKILL.md          # Main skill documentation
└── REFERENCE.md      # Detailed examples (optional)
```

---

## 🎯 When to Use Which Level

### User-Level (Personal, All Projects)

**MCP Servers:**
- ✅ General tools (Playwright, Figma, Search)
- ✅ Personal productivity (Context7)
- ✅ Common testing tools

**Skills:**
- ✅ Universal principles (UX, Accessibility, Clean Code)
- ✅ Language-agnostic patterns
- ✅ General web standards

### Project-Level (Team-Shared, This Project)

**MCP Servers:**
- ✅ Project-specific APIs
- ✅ Team collaboration (GitHub)
- ✅ Company-specific tools

**Skills:**
- ✅ Framework-specific (Laravel, React, Angular)
- ✅ Project conventions
- ✅ Company design systems

---

## ⚡ Quick Setup Commands

### New Project Setup (Copy-Paste Ready)

#### For Laravel Projects:

```bash
# 1. Navigate to project
cd /path/to/new/laravel/project

# 2. Add GitHub MCP (team collaboration)
claude mcp add --transport http github --scope project \
  https://api.githubcopilot.com/mcp/

# 3. Create Laravel patterns skill directory
mkdir -p .claude/skills/laravel-patterns

# 4. Copy Laravel patterns skill from existing project
cp -r /path/to/usceligin/.claude/skills/laravel-patterns/* \
  .claude/skills/laravel-patterns/

# 5. Commit to git
git add .mcp.json .claude/
git commit -m "feat: Add MCP servers and Laravel patterns skill"
```

#### For React Projects:

```bash
# 1. Navigate to project
cd /path/to/new/react/project

# 2. Add GitHub MCP
claude mcp add --transport http github --scope project \
  https://api.githubcopilot.com/mcp/

# 3. Add Playwright for component testing (optional, or use user-level)
claude mcp add --transport stdio playwright --scope project \
  -- npx -y playwright-mcp

# 4. Create React patterns skill
mkdir -p .claude/skills/react-patterns

# 5. Create SKILL.md for React
# (Define React hooks, components, testing patterns)

# 6. Commit to git
git add .mcp.json .claude/
git commit -m "feat: Add MCP servers and React patterns skill"
```

#### For Any Web Project:

```bash
# User-level tools are already available!
# Just verify:
claude mcp list

# You should see:
# ✓ context7
# ✓ duckduckgo
# ✓ sequentialthinking
# ✓ playwright
# ✓ figma

# User-level skills are already available!
ls ~/.claude/skills/
# accessibility/
# ui-development/
# user-experience/
```

---

## 📁 Complete Directory Structure

### User-Level Configuration

```
C:\Users\<username>\
├── .claude.json                    # MCP servers configuration
└── .claude\
    └── skills\
        ├── accessibility\
        │   └── SKILL.md
        ├── ui-development\
        │   └── SKILL.md
        └── user-experience\
            └── SKILL.md
```

### Project-Level Configuration

```
/path/to/project/
├── .mcp.json                       # Project MCP servers
└── .claude\
    └── skills\
        └── laravel-patterns\       # Or react-patterns, angular-patterns, etc.
            ├── SKILL.md
            └── REFERENCE.md
```

---

## 🔍 Troubleshooting

### MCP Server Not Connecting

```bash
# Check server health
claude mcp list

# Restart Claude Code
# Exit and relaunch

# For stdio servers (playwright, duckduckgo):
# Make sure packages are installed globally or npx can download them

# For HTTP servers (figma, github):
# Authenticate in Claude Code session
```

### Skills Not Working

```bash
# Verify skill files exist
ls ~/.claude/skills/accessibility/SKILL.md
ls .claude/skills/laravel-patterns/SKILL.md

# Check YAML frontmatter is valid
head -n 10 ~/.claude/skills/accessibility/SKILL.md

# Restart Claude Code to reload skills
```

### Can't Find ~/.claude.json

**Windows:**
```bash
# Open in File Explorer
explorer %USERPROFILE%\.claude.json

# Or use full path
C:\Users\<your-username>\.claude.json
```

**Mac/Linux:**
```bash
# Open in terminal
open ~/.claude.json

# Or view with cat
cat ~/.claude.json
```

---

## 📚 Skill Files Reference

All skill files are located in this repository:

```
usceligin/
└── .claude\
    └── skills\
        └── laravel-patterns\
            ├── SKILL.md
            └── REFERENCE.md

User skills are at:
~/.claude/skills/
├── accessibility/SKILL.md
├── ui-development/SKILL.md
└── user-experience/SKILL.md
```

**To copy skills to new project:**

```bash
# Copy user-level skills (if setting up on new machine)
cp -r /path/to/usceligin/.claude/skills/* ~/.claude/skills/

# Copy project-level skills
cp -r /path/to/usceligin/.claude/skills/laravel-patterns \
  /path/to/new/project/.claude/skills/
```

---

## ✅ Installation Checklist

### One-Time Setup (New Machine)

- [ ] Install user-level MCP servers (Context7, DuckDuckGo, etc.)
- [ ] Install Playwright browsers: `npx playwright install chromium`
- [ ] Copy user-level skills to `~/.claude/skills/`
- [ ] Verify with `claude mcp list`

### Per-Project Setup

- [ ] Add project-level MCP servers (GitHub, etc.)
- [ ] Create `.claude/skills/` directory
- [ ] Copy or create project-specific skills
- [ ] Commit `.mcp.json` and `.claude/skills/` to git
- [ ] Team members run `git pull` to get configuration

---

## 🎯 Summary

### User-Level (Once per machine)
```bash
# MCP Servers
✅ Context7 (with API key)
✅ DuckDuckGo
✅ Sequential Thinking
✅ Playwright (+ install browsers)
✅ Figma

# Skills
✅ accessibility
✅ ui-development
✅ user-experience
```

### Project-Level (Once per project)
```bash
# MCP Servers
✅ GitHub (team collaboration)
✅ Any project-specific servers

# Skills
✅ laravel-patterns (Laravel projects)
✅ react-patterns (React projects)
✅ angular-patterns (Angular projects)
✅ etc.
```

---

**Need Help?**

- MCP Documentation: https://code.claude.com/docs/en/mcp
- Skills Documentation: https://code.claude.com/docs/en/skills
- This Project: See `CLAUDE.md` and `MCP_TEST_RESULTS.md`

---

**Last Updated:** 2025-12-22
**Project:** Usceligin Laravel E-Commerce
**Maintained By:** Development Team
