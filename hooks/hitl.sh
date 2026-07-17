#!/bin/bash
# Hook: Human-in-the-loop review required
# This runs when a [HITL] subtask is moved to "In Review"
afplay /System/Library/Sounds/Glass.aiff 2>/dev/null || echo "[HITL] Review required"
