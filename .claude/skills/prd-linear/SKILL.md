---
name: prd-linear
description: Create a PRD as a Linear parent issue with child issues for implementation tasks, using team key from .ralph.toml.
---
# /prd-linear - Create a PRD in Linear

## Usage

```
/prd-linear <feature description>
/prd-linear
```

If no description is provided, ask clarifying questions to understand the feature.

## Behavior

1. **Read Config**: Read `LINEAR_TEAM` from `.ralph.toml` in the project root to get the team key (e.g. `SAB`)
2. **Gather Requirements**: Ask clarifying questions to fully understand the feature scope
3. **Research Codebase**: Explore relevant existing code, models, and patterns
4. **Resolve Team**: Look up the team ID for the configured team key via the Linear API
5. **Create Parent Issue**: Create a parent issue in Linear with the full PRD as the description
6. **Create Child Issues**: Create a child issue for each implementation task, linked to the parent

## Config

Read the Linear team key from `.ralph.toml` at the project root:

```toml
linear-team = "SAB"
```

If `.ralph.toml` is missing or `linear-team` is not set, ask the user which team to use.

## Linear API

- **Endpoint**: `https://api.linear.app/graphql`
- **Auth header**: `Authorization: $LINEAR_API_KEY` (no "Bearer" prefix — the key is sent raw)

### Step 1: Read team key from config and resolve team ID

First, read `LINEAR_TEAM` from `.ralph.toml`. Then resolve it:

```bash
curl -s -X POST https://api.linear.app/graphql \
  -H "Content-Type: application/json" \
  -H "Authorization: $LINEAR_API_KEY" \
  -d '{"query":"query { teams(filter: { key: { eq: \"TEAM_KEY\" } }) { nodes { id name key } } }"}'
```

Replace `TEAM_KEY` with the value from `.ralph.toml`.

Extract `data.teams.nodes[0].id` — this is the `teamId` for all subsequent calls.

### Step 2: Resolve the "Backlog" state ID (for new issues)

```bash
curl -s -X POST https://api.linear.app/graphql \
  -H "Content-Type: application/json" \
  -H "Authorization: $LINEAR_API_KEY" \
  -d "{\"query\":\"query { team(id: \\\"TEAM_ID\\\") { states { nodes { id name } } } }\"}"
```

Use the state named **"Backlog"** for new issues.

### Step 3: Create the parent issue

```bash
curl -s -X POST https://api.linear.app/graphql \
  -H "Content-Type: application/json" \
  -H "Authorization: $LINEAR_API_KEY" \
  -d '{
    "query": "mutation CreateIssue($input: IssueCreateInput!) { issueCreate(input: $input) { success issue { id identifier title url } } }",
    "variables": {
      "input": {
        "teamId": "TEAM_ID",
        "title": "Feature: <feature name>",
        "description": "<full PRD markdown>",
        "priority": 2
      }
    }
  }'
```

Extract `data.issueCreate.issue.id` as the `parentId` for child issues. Priority values: 1=Urgent, 2=High, 3=Medium, 4=Low.

### Step 4: Create child issues for each implementation task

For each task from the PRD's "Implementation Tasks" section, create a child issue:

```bash
curl -s -X POST https://api.linear.app/graphql \
  -H "Content-Type: application/json" \
  -H "Authorization: $LINEAR_API_KEY" \
  -d '{
    "query": "mutation CreateIssue($input: IssueCreateInput!) { issueCreate(input: $input) { success issue { id identifier title url } } }",
    "variables": {
      "input": {
        "teamId": "TEAM_ID",
        "parentId": "PARENT_ISSUE_ID",
        "title": "<task title>",
        "description": "<task details and acceptance criteria>",
        "priority": 2,
        "stateId": "STATE_ID"
      }
    }
  }'
```

Map priority from the PRD:
- **High Priority** tasks → priority `2`
- **Medium Priority** tasks → priority `3`
- **Low Priority** tasks → priority `4`

## Parent Issue Description Template

The parent issue description should follow this markdown structure:

```markdown
## Overview
Brief 2-3 sentence description of what this feature does and why it's needed.

## Goals
- Primary goal
- Secondary goals

## User Stories
- As a [role], I want [feature] so that [benefit]

## Requirements

### Functional Requirements
1. Requirement with clear acceptance criteria

### Non-Functional Requirements
- Performance, security, accessibility considerations

## Technical Approach

### Affected Areas
- Models, Controllers, Frontend, Routes

### Database Changes
- New tables or columns, migrations needed

### API Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST   | /api/... | Create...   |

## Edge Cases
- Edge case and how to handle it

## Out of Scope
- Features explicitly NOT included

## Open Questions
- [ ] Questions that need answering before implementation
```

## Child Issue Description

Each child issue should include:
- What needs to be done (clear task description)
- Acceptance criteria
- Any relevant technical notes or pointers to existing code

## Guidelines

1. **Be Specific**: Vague requirements lead to misaligned implementations
2. **Include Context**: Explain WHY, not just WHAT
3. **Reference Existing Code**: Point to similar patterns in the codebase
4. **Consider Edge Cases**: Think through error states and unusual inputs
5. **Define Success**: Clear acceptance criteria for each requirement
6. **Keep Scope Bounded**: Explicitly state what's out of scope

## Output

After creating all issues, display a summary:

```
Parent: SAB-123 — Feature: <name>
  URL: https://linear.app/...

Child issues:
  SAB-124 — Task 1 (High)
  SAB-125 — Task 2 (High)
  SAB-126 — Task 3 (Medium)
  SAB-127 — Task 4 (Low)
```

## Important Notes

- Use `$LINEAR_API_KEY` environment variable — never hardcode the key
- All `curl` output should be parsed with `jq` for readability
- If any API call fails, stop and report the error — do not continue creating child issues if the parent failed
