## Top 4 Users by Total Spend in Last 90 Days
Pichhle 90 din me sabse zyada total spend karne wale top 4 users ko nikalna.
- Sirf woh orders count karne jo status 'paid' ya 'completed' me hain.
- Sirf un users ko include karna jinke kam se kam 3 orders ho is period me.

Process:
1. Database connection 'config.php' se hota hai.
2. SQL query me:
#   - SUM(total_amount) se user ka total spend nikala jaata hai.
#   - COUNT(*) se total orders count hote hain.
#   - GROUP_CONCAT se har order ka detail combine hota hai (created_at, total_amount, status).
#   - GROUP BY user_id se har user ka data group hota hai.
#   - HAVING clause me filter lagta hai:
#     a) created_at last 90 days me.
#     b) status 'paid' ya 'completed' ho.
#     c) minimum orders 3 ya usse zyada.
#   - ORDER BY total_amount DESC se highest spenders top par aate hain.
#   - LIMIT 0,4 se sirf top 4 results aate hain.
3. Agar result milta hai to JSON format me return hota hai.
4. Agar result na mile to HTTP 404 ke saath error JSON return hota hai.
