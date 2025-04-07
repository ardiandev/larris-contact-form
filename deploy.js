const { execSync } = require("child_process");

const commitMessage = process.argv[2];

if (!commitMessage) {
  console.error("❌ Please provide a commit message.");
  process.exit(1);
}

try {
  console.log("🔧 Building project...");
  execSync("npm run build", { stdio: "inherit" });

  console.log("📦 Staging files...");
  execSync("git add .", { stdio: "inherit" });

  console.log("📝 Committing with message:", commitMessage);
  execSync(`git commit -m "${commitMessage}"`, { stdio: "inherit" });

  console.log("🚀 Pushing to origin main...");
  execSync("git push origin main", { stdio: "inherit" });

  console.log("✅ Deploy complete.");
} catch (err) {
  console.error("⚠️ Deployment failed:", err.message);
  process.exit(1);
}
