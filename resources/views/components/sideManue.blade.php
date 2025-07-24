<aside style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(to bottom, #ffffff, #f8f9fa); border-left: 1px solid #e0e0e0; display: flex; flex-direction: column; height: 100vh; box-shadow: -2px 0 10px rgba(0,0,0,0.05);">
    <div style="flex: 1; overflow-y: auto;">
        <div style="padding: 15px;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <thead style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: white;">
                        <tr>
                            <th colspan="3" style="padding: 12px; text-align: center; font-size: 16px; font-weight: 600;">
                                <span style="margin-right: 8px;">📊</span> STOCK QTY / REGION (in office)
                            </th>
                        </tr>
                        <tr style="background: #f1f1f1; color: #333;">
                            <th style="padding: 10px; text-align: center; font-weight: 500; border-right: 1px solid #ddd;">
                                <span style="margin-right: 6px;">🌍</span> Region
                            </th>
                            <th style="padding: 10px; text-align: center; font-weight: 500; border-right: 1px solid #ddd;">
                                <span style="margin-right: 6px;">💻</span> POS
                            </th>
                            <th style="padding: 10px; text-align: center; font-weight: 500;">
                                <span style="margin-right: 6px;">🖨️</span> Thermo Printer
                            </th>
                        </tr>
                    </thead>
                    <tbody id="stock-table-body" style="background-color: #fff;">
                        <!-- Sample row - remove in production -->
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px; text-align: center; border-right: 1px solid #eee;">Dar</td>
                            <td style="padding: 10px; text-align: center; border-right: 1px solid #eee; color: #3498db; font-weight: 500;">12</td>
                            <td style="padding: 10px; text-align: center; color: #e74c3c; font-weight: 500;">8</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px; text-align: center; border-right: 1px solid #eee;">Mwanza</td>
                            <td style="padding: 10px; text-align: center; border-right: 1px solid #eee; color: #3498db; font-weight: 500;">7</td>
                            <td style="padding: 10px; text-align: center; color: #e74c3c; font-weight: 500;">5</td>
                        </tr>
                        <!-- Data will be appended here -->
                    </tbody>
                    <tfoot style="background: linear-gradient(135deg, #f39c12, #e67e22); color: white;">
                        <tr>
                            <td style="padding: 10px; text-align: center; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">
                                <span style="margin-right: 6px;">🧮</span> Total
                            </td>
                            <td style="padding: 10px; text-align: center; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);" id="total-pos">19</td>
                            <td style="padding: 10px; text-align: center; font-weight: 600;" id="total-printer">13</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- <div style="margin-top: auto; padding: 25px;">
        <div style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: white; border-radius: 8px; padding: 15px; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 18px; color: rgba(255,255,255,0.8);" onclick="this.parentElement.style.display='none';">×</div>
            <h5 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 600; display: flex; align-items: center;">
                <span style="margin-right: 8px;">✅</span> Well done!
            </h5>
            <p style="margin: 0; font-size: 14px; opacity: 0.9;">
                <span style="margin-right: 6px;">⏳</span> Stock is about to close
            </p>
        </div>
    </div> -->
</aside>